"""Small Flask server for the Plant Story identification page."""

import base64
import os
from io import BytesIO
from pathlib import Path

import requests
from flask import Flask, abort, render_template, request, send_from_directory
from werkzeug.exceptions import RequestEntityTooLarge


# Project and API configuration
ROOT = Path(__file__).resolve().parent.parent
app = Flask(__name__, template_folder=str(ROOT), static_folder=None)
app.config["MAX_CONTENT_LENGTH"] = 10 * 1024 * 1024
PLANTNET_URL = "https://my-api.plantnet.org/v2/identify/all"


# Page and static-file routes
@app.get("/")
def identify_page():
    return render_template("identify.html")


@app.get("/identify.html")
def identify_html_page():
    return render_template("identify.html")


@app.get("/identify")
def identify_route():
    return render_template("identify.html")


@app.get("/<path:filename>")
def public_file(filename):
    public_extensions = {
        ".css", ".html", ".jpg", ".jpeg", ".png", ".svg", ".webp",
        ".gif", ".ico", ".json", ".mp3", ".wav", ".ogg", ".pdf",
    }
    parts = Path(filename).parts
    allowed_folders = {"css", "images", "profile", "songs"}
    if (
        Path(filename).suffix.lower() not in public_extensions
        or (len(parts) > 1 and parts[0] not in allowed_folders)
    ):
        abort(404)
    return send_from_directory(ROOT, filename)


# PlantNet identification route
@app.post("/identify")
def identify_plant():
    photo = request.files.get("plantphoto")
    if photo is None or not photo.filename:
        return render_template("identify.html", error="Choose a plant photo first."), 400

    if photo.mimetype not in {"image/jpeg", "image/png"}:
        return render_template(
            "identify.html", error="Please upload a JPG or PNG image."
        ), 400

    image_bytes = photo.read()
    image_preview = "data:%s;base64,%s" % (photo.mimetype, base64.b64encode(image_bytes).decode("ascii"))

    api_key = os.environ.get("PLANTNET_API_KEY")
    if not api_key:
        return render_template(
            "identify.html",
            error="Plant identification is not configured yet. Add a PlantNet API key to PLANTNET_API_KEY and restart the app.",
        ), 503

    try:
        response = requests.post(
            PLANTNET_URL,
            params={"api-key": api_key, "lang": "en", "nb-results": 3},
            files={"images": (Path(photo.filename).name, BytesIO(image_bytes), photo.mimetype)},
            data={"organs": "auto"},
            timeout=45,
        )
    except requests.Timeout:
        return render_template(
            "identify.html", error="PlantNet took too long to respond. Please try again."
        ), 504
    except requests.RequestException:
        return render_template(
            "identify.html", error="Could not reach PlantNet. Check your connection and try again."
        ), 502

    if response.status_code == 429:
        return render_template(
            "identify.html", error="Today's PlantNet identification limit has been reached. Please try again tomorrow."
        ), 429
    if response.status_code in {401, 403}:
        return render_template(
            "identify.html", error="PlantNet rejected the API key. Check PLANTNET_API_KEY and try again."
        ), 502
    if not response.ok:
        return render_template(
            "identify.html", error="PlantNet could not identify this photo. Try a clearer plant image."
        ), 502

    payload = response.json()
    results = [
        {
            "name": result.get("species", {}).get("scientificNameWithoutAuthor")
            or result.get("species", {}).get("scientificName", "Unknown species"),
            "score": result.get("score", 0),
        }
        for result in payload.get("results", [])
    ]
    if not results:
        return render_template(
            "identify.html", error="No plant match found. Try a clearer photo of its leaves or flowers."
        ), 200

    return render_template("identify.html", results=results, image_preview=image_preview)


# Friendly upload error
@app.errorhandler(RequestEntityTooLarge)
def photo_too_large(_error):
    return render_template(
        "identify.html", error="That photo is over 10 MB. Choose a smaller image."
    ), 413


if __name__ == "__main__":
    app.run(debug=False)

"""Small Flask server for the Plant Story identification page."""

import base64
import os
from io import BytesIO
from pathlib import Path

import requests
from dotenv import load_dotenv
from flask import Flask, abort, render_template, request, send_from_directory
from werkzeug.exceptions import RequestEntityTooLarge


# Project and API configuration
ROOT = Path(__file__).resolve().parent.parent
load_dotenv(ROOT / ".env")
app = Flask(__name__, template_folder=str(ROOT), static_folder=None)
app.config["MAX_CONTENT_LENGTH"] = 10 * 1024 * 1024
PLANTNET_URL = "https://my-api.plantnet.org/v2/identify/all"

# Genus-level care guidance, grounded in the native habitat described for
# each genus on the Genera page (explore2.html). Care advice is general by
# necessity — it is not available at species precision from any source we
# have, so we generalise honestly at genus level rather than guess.
GENUS_CARE_INFO = {
    "horsfieldia": {
        "environment": "Warm, humid tropical rainforest, usually as a canopy or sub-canopy tree.",
        "care": "Needs consistent warmth (20-30°C), high humidity and bright but filtered light. Keep soil moist and rich in organic matter with good drainage; avoid letting it dry out or sit in stagnant water.",
    },
    "knema": {
        "environment": "Warm, humid tropical rainforest, from the understorey to the mid-canopy.",
        "care": "Needs consistent warmth, high humidity and filtered light. Keep soil moist and rich in organic matter with good drainage.",
    },
    "parastemon": {
        "environment": "Tropical peat-swamp and heath forest with consistently wet, acidic, nutrient-poor soils.",
        "care": "Prefers constantly moist to waterlogged, acidic soil and warm, humid air; tolerates low-nutrient conditions but needs full to partial sun as a canopy species.",
    },
    "hirtella": {
        "environment": "Humid tropical rainforest understorey of Central and South America.",
        "care": "Grow in warm, shaded to dappled-light conditions with consistently moist, well-drained, humus-rich soil, mimicking a forest-floor setting.",
    },
    "aglaia": {
        "environment": "Tropical lowland rainforest, often as a canopy or emergent tree.",
        "care": "Needs full sun to light shade once established, warm humid conditions, and deep, fertile, well-drained soil; young plants benefit from partial shade.",
    },
    "dysoxylum": {
        "environment": "Tropical and subtropical rainforest, from lowland to lower-montane forest.",
        "care": "Prefers warm temperatures, high humidity, and deep, well-drained, fertile soil; tolerates partial shade when young but grows best with good light as a mature tree.",
    },
    "diospyros": {
        "environment": "Varies by species, from tropical forest interiors to coastal and island vegetation across Asia and the Pacific.",
        "care": "Generally prefers warm temperatures, moderate-to-high humidity and well-drained soil; established plants tolerate some drought but grow best with regular water and full sun to partial shade.",
    },
    "euclea": {
        "environment": "Dry savanna, bushveld, coastal dune scrub and semi-arid woodland in Africa.",
        "care": "Drought-tolerant once established; needs full sun, well-drained (often sandy) soil, and only occasional watering — avoid humid, waterlogged conditions.",
    },
}

# Species-level common name and origin, as documented on the Species page
# (explore3.html). Only the 16 species profiled on this site are covered;
# anything else PlantNet identifies will show the scientific name and
# confidence only, rather than guessed care/origin details.
SPECIES_CATALOG_INFO = {
    "horsfieldia flocculosa": {"common_name": None, "origin": "Peninsular Malaysia and Sumatra, Indonesia.", "genus": "horsfieldia"},
    "horsfieldia kingii": {"common_name": "Ramtamul (Assamese)", "origin": "Nepal, India, Bangladesh, Myanmar, Thailand, Vietnam and China.", "genus": "horsfieldia"},
    "knema cinerea": {"common_name": None, "origin": "Indonesia (Lesser Sundas, Sulawesi, Moluccas) and the Philippines.", "genus": "knema"},
    "knema sumatrana": {"common_name": None, "origin": "Thailand, Peninsular Malaysia and Sumatra, Indonesia.", "genus": "knema"},
    "parastemon urophyllus": {"common_name": "Nyilas Padang, Malas", "origin": "Andaman & Nicobar Islands (India), Myanmar, Thailand, Malaysia, Singapore, Indonesia and Brunei.", "genus": "parastemon"},
    "parastemon grandifructus": {"common_name": None, "origin": "Sabah and Sarawak (Malaysia), and Brunei — a Borneo endemic.", "genus": "parastemon"},
    "hirtella triandra": {"common_name": "Pigeonberry", "origin": "Mexico through Central America to Brazil, Bolivia and the Caribbean.", "genus": "hirtella"},
    "hirtella racemosa": {"common_name": "Azeitona-da-mata (Brazil)", "origin": "Mexico through Central America and the Caribbean to Peru, Bolivia and Brazil.", "genus": "hirtella"},
    "aglaia elliptica": {"common_name": "Lambunau (Malaysia)", "origin": "Myanmar, Thailand, Malaysia, Brunei, Indonesia and the Philippines.", "genus": "aglaia"},
    "aglaia korthalsii": {"common_name": "Keriat / Sekiat (Malay)", "origin": "Bhutan, the Nicobar Islands (India), Myanmar, Thailand, Vietnam, Malaysia and Indonesia.", "genus": "aglaia"},
    "dysoxylum acutangulum": {"common_name": "Membalo (trade name), Bekak (Malaysia), Langkang (Borneo)", "origin": "Thailand to Malesia, the Solomon Islands and northern Australia.", "genus": "dysoxylum"},
    "dysoxylum grande": {"common_name": None, "origin": "Bhutan, India, Bangladesh, Myanmar, China, and mainland & western Malesia.", "genus": "dysoxylum"},
    "diospyros ferrea": {"common_name": "Black ebony, English ironwood", "origin": "India and Sri Lanka to Melanesia, Micronesia, Polynesia and Hawaii.", "genus": "diospyros"},
    "diospyros ebenum": {"common_name": "Ceylon ebony, East Indian ebony, True ebony", "origin": "Southern India and Sri Lanka.", "genus": "diospyros"},
    "euclea natalensis": {"common_name": "Natal guarri", "origin": "Ethiopia and Somalia south through East Africa to South Africa.", "genus": "euclea"},
    "euclea racemosa": {"common_name": "Sea guarrie, Dune guarrie", "origin": "Egypt, the Arabian Peninsula, East Africa to South Africa, and the Comoros.", "genus": "euclea"},
}


def catalog_lookup(scientific_name):
    """Look up care/environment/origin for a species in our own 16-species
    catalogue, keyed by scientific name. Returns None for anything else."""
    entry = SPECIES_CATALOG_INFO.get(scientific_name.strip().lower())
    if not entry:
        return None
    genus_info = GENUS_CARE_INFO.get(entry["genus"], {})
    return {
        "common_name": entry["common_name"],
        "origin": entry["origin"],
        "environment": genus_info.get("environment"),
        "care": genus_info.get("care"),
    }


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
    allowed_folders = {"css", "images", "profile", "songs", "login register"}
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
    results = []
    for result in payload.get("results", []):
        species = result.get("species", {})
        name = species.get("scientificNameWithoutAuthor") or species.get("scientificName", "Unknown species")
        catalog_info = catalog_lookup(name)
        plantnet_common_names = species.get("commonNames") or []
        results.append({
            "name": name,
            "score": result.get("score", 0),
            "common_name": (catalog_info or {}).get("common_name") or (", ".join(plantnet_common_names[:3]) or None),
            "origin": (catalog_info or {}).get("origin"),
            "environment": (catalog_info or {}).get("environment"),
            "care": (catalog_info or {}).get("care"),
            "in_catalog": catalog_info is not None,
        })
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

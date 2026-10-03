# Plant identification setup

Python support is kept in the `backend` folder:

- `backend/app.py` — Flask server and PlantNet request.
- `backend/requirements.txt` — Python packages.
- `backend/IDENTIFY-SETUP.md` — this guide.

Plant identification runs through the Flask server and Pl@ntNet. Open the page
from the server instead of opening `identify.html` directly from File Explorer.

1. Create a free Pl@ntNet developer account at <https://my.plantnet.org/> and
   copy your API key.
2. Copy `.env.example` to `.env` (in the project root) and paste your key in:

   ```
   PLANTNET_API_KEY=your-actual-key-here
   ```

3. In PowerShell, from this project folder, run:

   ```powershell
   python -m pip install -r backend\requirements.txt
   python backend\app.py
   ```

4. Open <http://127.0.0.1:5000/>. The API key is loaded from `.env` by
   python-dotenv and is never placed in the web page. `.env` is listed in
   `.gitignore` so it is never committed or pushed to GitHub.

The Pl@ntNet free plan currently allows 500 identifications per day. Uploaded
JPG and PNG images are sent to Pl@ntNet for identification.

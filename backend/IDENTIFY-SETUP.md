# Plant identification setup

Python support is kept in the `backend` folder:

- `backend/app.py` — Flask server and PlantNet request.
- `backend/requirements.txt` — Python packages.
- `backend/IDENTIFY-SETUP.md` — this guide.

Plant identification runs through the Flask server and Pl@ntNet. Open the page
from the server instead of opening `identify.html` directly from File Explorer.

1. Create a free Pl@ntNet developer account at <https://my.plantnet.org/> and
   copy your API key.
2. In PowerShell, from this project folder, run:

   ```powershell
   python -m pip install -r backend\requirements.txt
   $env:PLANTNET_API_KEY = "paste-your-key-here"
   python backend\app.py
   ```

3. Open <http://127.0.0.1:5000/>. The API key is read by Python from the
   environment and is never placed in the web page.

The Pl@ntNet free plan currently allows 500 identifications per day. Uploaded
JPG and PNG images are sent to Pl@ntNet for identification.

# Automated Evidence Presentation

This module provides a lightweight Flask application for ingesting evidence files and auto-generating a PowerPoint presentation. It demonstrates basic functionality requested in the "Automated Evidence Presentation" feature.

## Features

- Drag & drop / file-picker web form for uploading evidence
- Generates a slide for each uploaded file using **python-pptx**
- Saves an audit log to `presentation.log`
- Exports a PowerPoint presentation (`presentation.pptx`)

## Quick Start

```bash
pip install flask python-pptx
python evidence_presentation/app.py
```

Open `http://localhost:5000` in your browser, upload some files, and a `presentation.pptx` will be generated for download.

## Limitations

This is a minimal prototype. It does not yet classify evidence types, build timelines, or export to PDF/web formats. Those would be added in a full implementation.

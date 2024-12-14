<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON File Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-header text-center">
                        <h4>Upload JSON File</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('upload_json') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jsonFile" class="form-label">Select JSON File</label>
                                <input class="form-control" type="file" name="jsonFile" id="jsonFile" accept=".json" required>
                            </div>
                            <div class="mb-3">
                                <label for="pdfLibrary" class="form-label">Select PDF Converter Library</label>
                                <select class="form-select" name="pdfLibrary" id="pdfLibrary" required>
                                    <option value="dompdf">Dompdf</option>
                                    <option value="tcpdf">TCPDF</option>
                                    <option value="mpdf">mPDF</option>
                                    <option value="snappy">wkhtmltopdf (Snappy)</option>
                                    <option value="fpdf">FPDF</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Upload and Convert to PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(session('pdfGenerated'))
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="alert alert-info">
                    <h5>Performance Report:</h5>
                    <p><strong>Duration:</strong> {{ session('duration') }}</p>
                    <p><strong>CPU Usage:</strong> {{ session('cpuUsage') }}</p>
                    <p><strong>High Peak RAM:</strong> {{ session('peakMemory') }}</p>
                    <a href="{{ route('download_pdf', ['path' => session('pdfPath')]) }}" class="btn btn-success mt-3">Download PDF</a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

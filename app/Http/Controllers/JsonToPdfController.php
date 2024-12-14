<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use TCPDF;
use Mpdf\Mpdf;
use Barryvdh\Snappy\Facades\SnappyPdf;

// For wkhtmltopdf
use FPDF;
use function Spatie\Ignition\Config\setOption;

class JsonToPdfController extends Controller
{
    public function uploadJson(Request $request)
    {
        $request->validate([
            // 'jsonFile' => 'required|file|mimes:json',
            'pdfLibrary' => 'required|string'
        ]);

        // Start capturing memory usage and CPU load before processing
        $startTime = microtime(true);
        $startMemory = memory_get_usage();
        $startCpu = getrusage();

        $jsonData = json_decode(file_get_contents($request->file('jsonFile')), true);
        $pdfLibrary = $request->input('pdfLibrary');
        $pdfPath = 'pdfs/output.pdf';

        foreach ($jsonData as &$email) {
            $email['body'] = isset($email['body']) ? strip_tags($email['body']) : '';
        }

        // Generate PDF using the selected library
        switch ($pdfLibrary) {
            case 'dompdf':
                $pdfPath = 'pdfs/dompdf_output.pdf';
                $pdf = Pdf::loadView('pdf_template', compact('jsonData'))->setPaper('A4')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => false]);
                $pdf->setOptions(['dpi' => 72]);
                Storage::put($pdfPath, $pdf->output());
                break;

            case 'tcpdf':
                $pdfPath = 'pdfs/tcpdf_output.pdf';
                $tcpdf = new TCPDF();
                $tcpdf->AddPage();

                $html = view('pdf_template', compact('jsonData'))->render();
                $tcpdf->writeHTML($html, true, false, true, false, '');
                $pdfOutput = $tcpdf->Output('output.pdf', 'S');
                Storage::put($pdfPath, $pdfOutput);
                break;

            case 'mpdf':
                $pdfPath = 'pdfs/mpdf_output.pdf';
                $mpdf = new Mpdf([
                    'tempDir' => storage_path('app/mpdf-temp'),
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 10,
                    'margin_bottom' => 10,
                    'margin_header' => 5,
                    'margin_footer' => 5,
                ]);

                $html = view('pdf_template', compact('jsonData'))->render();
                $mpdf->WriteHTML($html);
                Storage::put($pdfPath, $mpdf->Output('output.pdf', 'S'));
                break;

            case 'snappy': // wkhtmltopdf via Laravel Snappy
                $pdfPath = 'pdfs/snappy_output.pdf';
                //$pdf = SnappyPdf::loadView('pdf_template', compact('jsonData'))->setTemporaryFolder(storage_path());
                $pdf = $this->createPDFViaSnappy($jsonData);
                Storage::put($pdfPath, $pdf->output());
                break;

            case 'fpdf': // FPDF
                $pdfPath = 'pdfs/fpdf_output.pdf';
                $fpdf = new FPDF();
                $fpdf->AddPage();
                $fpdf->SetFont('Arial', 'B', 16);
                foreach ($jsonData as $email) {
                    $fpdf->Cell(40, 10, 'From: ' . $email['from']);
                    $fpdf->Ln();
                    $fpdf->Cell(40, 10, 'Date: ' . $email['date']);
                    $fpdf->Ln();
                    $fpdf->Cell(40, 10, 'Subject: ' . $email['subject']);
                    $fpdf->Ln();
                    $fpdf->MultiCell(0, 10, 'Body: ' . $email['body']);
                    $fpdf->AddPage();
                }
                $pdfOutput = $fpdf->Output('S');
                Storage::put($pdfPath, $pdfOutput);
                break;

            default:
                return redirect('/json-to-pdf')->withErrors(['pdfLibrary' => 'Invalid PDF Library selected']);
        }

        // Capture metrics after processing
        $endTime = microtime(true);
        $endMemory = memory_get_peak_usage();
        $endCpu = getrusage();

        // Calculate the duration
        $duration = $endTime - $startTime;

        // Calculate the CPU time (user time + system time)
        $cpuTime = ($endCpu["ru_utime.tv_sec"] - $startCpu["ru_utime.tv_sec"]) +
            ($endCpu["ru_utime.tv_usec"] - $startCpu["ru_utime.tv_usec"]) / 1e6 +
            ($endCpu["ru_stime.tv_sec"] - $startCpu["ru_stime.tv_sec"]) +
            ($endCpu["ru_stime.tv_usec"] - $startCpu["ru_stime.tv_usec"]) / 1e6;

        // Calculate CPU usage as a percentage
        $cpuUsage = ($cpuTime / $duration) * 100;

        // Convert memory usage to human-readable format
        $memoryUsage = $this->convertToReadableSize($endMemory - $startMemory);
        $peakMemory = $this->convertToReadableSize($endMemory);

        return redirect('/json-to-pdf')->with([
            'duration' => round($duration, 2) . ' seconds',
            'cpuUsage' => round($cpuUsage, 2) . '%',
            'peakMemory' => $peakMemory,
            'pdfGenerated' => true,
            'pdfPath' => $pdfPath,
        ]);
    }

    private function createPDFViaSnappy($jsonData)
    {
        $logo = asset('web/assets/img/resize-image/logo-192x192.png');
        $dateAt = now()->format('d/m/Y');
        $timeAt = now()->format('H:i:s');
        $singleMessage = $jsonData[0];
        $fromUserName = extractName($singleMessage['from']);
        $fromEmail = extractEmail($singleMessage['from']);
        $toUserName = extractName($singleMessage['to']);
        $toEmail = extractEmail($singleMessage['to']);
        $authUser = $fromEmail;
        $countData = count($jsonData);
        $language = 'en';
        $text1 = $language == 'he' ? "מאובטח, מהיר ומעוצב" : "FAST & SECURED";
        $text2 = $language == 'en' ? 'מחלץ התכתבויות דוא"ל ל- PDF' : "Emails and Chats Extractor";

        $html = view('new_pdf_design_part_2', compact(
            'jsonData',
            'language',
            'logo',
            'fromUserName',
            'authUser',
            'dateAt',
            'timeAt',
            'countData',
            'fromEmail',
            'toUserName',
            'toEmail',
            )
        )->render();

//        // Render the header view to HTML
//        $headerHtml = view('new_pdf_header_design',compact('logo','language','dateAt','timeAt'))->render();
//
//        $headerFileName = Str::random(12).".html";
//
//        // Save the rendered header HTML to a temporary file
//        $headerPath = storage_path($headerFileName);
//
//        File::put($headerPath, $headerHtml);

        $pdf = SnappyPdf::loadHTML($html)->setTemporaryFolder(storage_path())
                ->setOption('header-spacing',5)
                ->setOption('margin-top', '20mm')
                ->setOption('margin-bottom', '20mm')
                ->setOption('margin-left', '10mm')
                ->setOption('margin-right', '10mm')
                ->setOption('header-html', route('pdf.header',['language'=>$language,'dateAt'=>$dateAt,'timeAt'=>$timeAt]))
                ->setOption('print-media-type', true)
                ->setOption('footer-html', route('pdf.footer'))
                ->setOption('footer-spacing',10)
                ->setPaper('a4');

//        $pdf->setOptions([
//            'header-html' => view('new_pdf_header_design',compact('logo','text1','text2','dateAt','timeAt','language'))->render(),
//            'footer-html' => view('new_pdf_footer_design')->render(),
//        ]);

        return $pdf;
    }

    private function convertToReadableSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . ' ' . $units[$i];
    }
}

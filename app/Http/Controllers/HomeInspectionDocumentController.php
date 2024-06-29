<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\PhpWord;
use Dompdf\Options;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Writer\Pdf\Mpdf;
use PhpOffice\PhpWord\Shared\Html as HtmlConverter;
use \ConvertApi\ConvertApi;

class HomeInspectionDocumentController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function generateReport(Request $request)
    {
        //     Settings::setPdfRendererPath(base_path() . '/vendor/dompdf/dompdf');
        //     Settings::setPdfRendererName('DomPDF');
        //     var_dump(1);
        //     $template_path = storage_path('app\templates\inspection_template.docx');
        //     // var_dump($template_path); exit;
        //     $template_processor = new TemplateProcessor($template_path);

        //     $template_processor->setValue('address', $request->input('address'));
        //     $template_processor->setValue('contact_name', $request->input('contact_name'));
        //     $template_processor->setValue('phone_number', $request->input('phone_number'));
        //     $template_processor->setValue('email', $request->input('email'));
        //     $template_processor->setValue('estimated_age', $request->input('estimated_age'));
        //     $template_processor->setValue('building_type', $request->input('building_type'));
        //     $template_processor->setValue('state_of_occupancy', $request->input('state_of_occupancy'));
        //     $template_processor->setValue('inspection_date', $request->input('inspection_date'));
        //     $template_processor->setValue('start_time', $request->input('start_time'));
        //     $template_processor->setValue('end_time', $request->input('end_time'));

        //     // $temp_file_save_path = "app/temp/output_template.pdf";
        //     // $output_path = storage_path($temp_file_save_path);
        //     // $template_processor->saveAs($output_path);

        //     // return response()->download($output_path);
        //     $timestamp = now()->format('Y_m_d_H_i_s');
        //     $uuid = Str::uuid()->toString();
        //     $filename = "home_inspection_report_{$timestamp}_{$uuid}.pdf";

        //     // Save as a temporary file
        //     // $tempDocxFile = tempnam(sys_get_temp_dir(), 'docx');
        //     // $template_processor->saveAs($tempDocxFile);

        //     // // Convert to PDF
        //     // $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempDocxFile);
        //     // $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        //     // $tempPdfFile = sys_get_temp_dir() . '/' . $filename;
        //     // $pdfWriter->save($tempPdfFile);

        //     // // Return PDF response
        //     // return Response::download($tempPdfFile, $filename)->deleteFileAfterSend(true);
        //     $tempDocxFile = tempnam(sys_get_temp_dir(), 'docx');
        //     $template_processor->saveAs($tempDocxFile);

        //     // Load PHPWord object from the temporary DOCX file
        //     $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempDocxFile);

        //     // Save as a temporary PDF file
        //     $tempPdfFile = tempnam(sys_get_temp_dir(), 'pdf');
        //     $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        //     $pdfWriter->save($tempPdfFile);

        //     // Return PDF response
        //     return Response::download($tempPdfFile, 'document.pdf')->deleteFileAfterSend(true);
        // }
        // Path to PDF template


        // Ensure all input data is UTF-8 encoded
        // $address = $request->input('address');
        // $contactName = $request->input('contact_name');
        // $phoneNumber = $request->input('phone_number');
        // $email = $request->input('email');
        // $estimatedAge = $request->input('estimated_age');
        // $buildingType = $request->input('building_type');
        // $stateOfOccupancy = $request->input('state_of_occupancy');
        // $inspectionDate = $request->input('inspection_date');
        // $startTime = $request->input('start_time');
        // $endTime = $request->input('end_time');

        // // Path to PDF template
        // $templatePath = storage_path('app/templates/inspection_template.pdf');

        // // Create an instance of Dompdf
        // $pdf = new Dompdf();

        // // Load HTML content into Dompdf
        // $pdf->loadHtml('<html><body>'.
        //     '<p>Address: ' . htmlspecialchars($address) . '</p>'.
        //     '<p>Contact Name: ' . htmlspecialchars($contactName) . '</p>'.
        //     '<p>Phone Number: ' . htmlspecialchars($phoneNumber) . '</p>'.
        //     '<p>Email: ' . htmlspecialchars($email) . '</p>'.
        //     '<p>Estimated Age: ' . htmlspecialchars($estimatedAge) . '</p>'.
        //     '<p>Building Type: ' . htmlspecialchars($buildingType) . '</p>'.
        //     '<p>State of Occupancy: ' . htmlspecialchars($stateOfOccupancy) . '</p>'.
        //     '<p>Inspection Date: ' . htmlspecialchars($inspectionDate) . '</p>'.
        //     '<p>Start Time: ' . htmlspecialchars($startTime) . '</p>'.
        //     '<p>End Time: ' . htmlspecialchars($endTime) . '</p>'.
        //     '</body></html>');

        // // Set options for PDF rendering (optional)
        // $pdf->setPaper('A4', 'portrait');

        // // Render PDF
        // $pdf->render();

        // // Generate unique filename
        // $timestamp = now()->format('Y_m_d_H_i_s');
        // $uuid = \Illuminate\Support\Str::uuid()->toString();
        // $filename = "home_inspection_report_{$timestamp}_{$uuid}.pdf";

        // // Output generated PDF (download or display)
        // return $pdf->stream($filename);

        // Path to the PDF template
        $templatePath = storage_path('app/templates/inspection_template.docx');

        // Path to store the generated PDF
        $pdfPath = storage_path('app/public/generated.pdf');

        // Load the DOCX template
        $templateProcessor = new TemplateProcessor($templatePath);

        // Replace the merge fields with the input data
        $templateProcessor->setValue('address', $request->input('address'));

        // Save the modified DOCX to a temporary location
        $tempDocxPath = storage_path('app/public/generated.docx');
        $templateProcessor->saveAs($tempDocxPath);

        // Load the modified DOCX
        // $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempDocxPath);

        ConvertApi::setApiSecret('EnEev1OtGFW2uxY9');
        $result = ConvertApi::convert('pdf', [
                'File' => $tempDocxPath,
            ], 'docx'
        );

        $path = storage_path('app/templates/e/');
        $result->saveFiles($path);

        
    }
}

<?php
namespace App\Models;
//require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

/*
* This class was necessary beacuse the IOFactory was already declared for PhpWord in the Artwork.php model file. The entire function of this model is to
* write excel files for dowload 
*/
class Excel 
{
    public static function getExcelLink($docType, $id, $name, $disk, $artworks, $directory, $options = null)
    {
        $counter = 1; 
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', $name);
        $sheet->setCellValue('A2', 'Title');
        $sheet->setCellValue('B2', 'Description');
        $sheet->setCellValue('C2', 'Medium/Moyen');
        $sheet->setCellValue('D2', 'Dimensions');
        $sheet->setCellValue('E2', 'Gallery/Musée');
        $sheet->setCellValue('F2', 'Photographer/Photographe');
        $sheet->setCellValue('G2', 'Date');
        $sheet->setCellValue('H2', 'Link/Lien');
    
        foreach($artworks as $myArtwork) {
            if ($options != null) {
                if (in_array($counter, $options)) {
                    $sheet->setCellValue('A'.(2+$counter), $myArtwork->name);
                    $sheet->setCellValue('B'.(2+$counter), $myArtwork->description);
                    $sheet->setCellValue('C'.(2+$counter), $myArtwork->medium);
                    $sheet->setCellValue('D'.(2+$counter), $myArtwork->size_lenght . "x" . $myArtwork->size_width . "x" . $myArtwork->size_height);
                    $sheet->setCellValue('E'.(2+$counter), $myArtwork->location);
                    $sheet->setCellValue('F'.(2+$counter), $myArtwork->photographer);
                    $sheet->setCellValue('G'.(2+$counter), $myArtwork->date);
                    $sheet->setCellValue('H'.(2+$counter), $myArtwork->photographer_link);
                    $counter++;
                } else { 
                    $counter++;
                }
            } else {
                $sheet->setCellValue('A'.(2+$counter), $myArtwork->name);
                $sheet->setCellValue('B'.(2+$counter), $myArtwork->description);
                $sheet->setCellValue('C'.(2+$counter), $myArtwork->medium);
                $sheet->setCellValue('D'.(2+$counter), $myArtwork->size_lenght . "x" . $myArtwork->size_width . "x" . $myArtwork->size_height);
                $sheet->setCellValue('E'.(2+$counter), $myArtwork->location);
                $sheet->setCellValue('F'.(2+$counter), $myArtwork->photographer);
                $sheet->setCellValue('G'.(2+$counter), $myArtwork->date);
                $sheet->setCellValue('H'.(2+$counter), $myArtwork->photographer_link);
                $counter++;
            }
        }

        for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($directory . 'Documentation.xlsx');
    }
}
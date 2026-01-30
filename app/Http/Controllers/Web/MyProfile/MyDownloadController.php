<?php
namespace App\Http\Controllers\Web\MyProfile;

use Exception;
use ZipArchive;
use Carbon\Carbon;
use App\Models\Exhibit;
use App\Models\Artwork; 
use App\Models\User;
use App\Models\Group;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Controllers\Web\BaseController;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class MyDownloadController extends BaseController
{
    public function RequestHandler(Request $request)
    { 
        $doctype = $request->input('filetype');
        $name = $request->input('myname');
        $myProfile = null; 
        $myGroup = null; 
        $url = '';
        $directory = storage_path("/app/public/");
        $mediaDirectory = public_path("/media/");
        $zipdirectory = $directory . $doctype . "/";
        $this->directoryCheck($directory, $mediaDirectory);
        //if the request originates from an artwork, it will find an 'artworkid' input submitted with request
        try {
            $id = $request->input('artworkid');
            $artworks = array();
            $artwork = Artwork::where('id',$id)->first(); 
            //$artwork = DB::table('artworks')->where('id', $id)->first();
            array_push($artworks, $artwork);
            $myExhibit = Exhibit::where('id', $artworks[0]->exhibit_id)->first();
           
            $type = 'art';
            $options = null; 
            
                if ($artwork->exhibit->owner_type == "App\Models\Group") {
                    $myGroup = Group::where('id', $artwork->exhibit->owner_id)->first();
                   
                }else if($artwork->exhibit->owner_type == "App\Models\UserProfile") { 
                   $myProfile = UserProfile::where('id', $artwork->exhibit->owner_id)->first();
            
                } 
                //dd($artwork->exhibit->owner_type);
               // dd($myGroup);
               // dd($myProfile);
        }
        //if the request doesn't originate from an artwork, it is from an exhibit, and will find an 'exhibitid' input submitted with request
        catch(Exception $e) { 
            $count = $request->input('count');
            $id = $request->input('exhibitid');
            $myExhibit = Exhibit::where('id',$id)->first();
            $artworks = $myExhibit->artworks()->paginate();
            
            if ($myExhibit->owner_type == "App\Models\Group") {
                $myGroup = Group::where('id', $myExhibit->owner_id)->first();
              } else if($myExhibit->owner_type == "App\Models\UserProfile") {
                $myProfile = UserProfile::where('id', $myExhibit->owner_id)->first(); 
              }
            //dd($artwork->exhibit->owner_type);

            //  dd($myGroup);
            //  dd($myProfile);

            
            //if download options are submitted with the request, load them into an array 
            $options = array(); 
            for ($i=1; $i<=$count;$i++) {
                if ($request->input($i) > 0) {
                    array_push($options, $request->input($i));
                }
            }

            $type = 'exh';
        }

        finally {
            //Create the necessary files for download according to the request
            switch($doctype) {
                case 'docx':
                    $this->makeDOCX($name, $artworks, $directory, $options, $myProfile, $myGroup, $url);
                    $zipName = $this->makeZIP($type ,$mediaDirectory, $directory, $zipdirectory, $myExhibit, 'docx', $name, $artworks, $options);
                    break; 
                case 'pdf':
                    $this->makePDF($artworks, $name, $options, $myProfile, $myGroup, $url);
                    $zipName = $this->makeZIP($type,$mediaDirectory, $directory, $zipdirectory, $myExhibit, 'pdf', $name, $artworks, $options);
                    break; 
                case 'xlsx':
                    $this->makeXLSX($name, $artworks, $directory, $options, $myProfile, $myGroup, $url);
                    $zipName = $this->makeZIP($type, $mediaDirectory, $directory, $zipdirectory, $myExhibit, 'xlsx', $name, $artworks, $options);
                    break;
    
                case 'csv': 
                    $this->makeCSV($artworks, $name, $directory, $options, $myProfile, $myGroup, $url);
                    $zipName = $this->makeZIP($type, $mediaDirectory, $directory, $zipdirectory, $myExhibit, 'csv', $name, $artworks, $options);
                    break; 
            }
        }
        //return a link to download the file
        return response()->download($zipdirectory . '/' . $zipName);
    }

    public function makeZIP($type, $mediaDirectory,$directory, $zipdirectory, $myExhibit, $docType, $name, $artworks, $options = null)
    {
        $mytime = substr(Carbon::now()->toDateTimeString(), 0, 4);

        if ($type == "art") {
            $zipName = str_replace(' ', '', $artworks[0]->name. $name). $mytime. ".zip"; 
        } else if($type == "exh") {
            $zipName = str_replace(' ', '', $myExhibit->name. $name). $mytime. ".zip"; 
        }
        
        if (is_file($zipdirectory. $zipName))
        {
            unlink($zipdirectory.$zipName);
        }

        $zip = new ZipArchive();

        if ($zip->open($zipdirectory . $zipName, ZipArchive::CREATE) === TRUE) {
            $counter = 1; 
            $difference = 0;
            foreach($artworks as $myArtwork) {
                try {
                    if ($options != null) {
                        if (in_array($counter, $options)) {
                            $imagefolder = DB::table('media')->where('model_type', 'App\Models\Artwork')->where('model_id', $myArtwork->id)->first()->id;
                            $artworkFilename = DB::table('media')->where('model_type', 'App\Models\Artwork')->where('model_id', $myArtwork->id)->first()->file_name;

                            if ($counter - $difference < 10) {
                                $imagename =  str_replace(' ', '', '0'.($counter - $difference).$myArtwork->name. $name . $mytime . ".jpg");
                            }

                            if ($counter - $difference >= 10) {
                                $imagename =  str_replace(' ', '', ($counter - $difference).$myArtwork->name. $name . $mytime . ".jpg");
                            }

                            if (filesize($mediaDirectory . $imagefolder . "/" . $artworkFilename) > 1500000) {
                                throw new Exception('image file too large');
                            }

                            $zip->addFile($mediaDirectory. $imagefolder . "/" . $artworkFilename, $imagename);
                            $counter++;

                            if (file_exists($zip->getFromName('blankimage.jpg'))) {
                                $zip->deleteName('blankimage.jpg'); 
                            }  
                        } else{ 
                            $counter++;$difference++;
                        }
                    } else if($options == null) {
                        $imagefolder = DB::table('media')->where('model_type', 'App\Models\Artwork')->where('model_id', $myArtwork->id)->first()->id;
                        $artworkFilename = DB::table('media')->where('model_type', 'App\Models\Artwork')->where('model_id', $myArtwork->id)->first()->file_name;

                        if ($counter - $difference < 10) {
                            $imagename =  str_replace(' ', '', '0'.($counter - $difference).$myArtwork->name. $name . $mytime . ".jpg");
                        }

                        if ($counter - $difference >= 10) {
                            $imagename =  str_replace(' ', '', ($counter - $difference).$myArtwork->name. $name . $mytime . ".jpg");
                        }

                        if (filesize($mediaDirectory . $imagefolder . "/" . $artworkFilename) > 1500000) {
                            throw new Exception('image file too large');
                        }

                        $zip->addFile($mediaDirectory . $imagefolder . "/" . $artworkFilename, $imagename);
                        $counter++;

                        if (file_exists($zip->getFromName('blankimage.jpg'))) {
                            $zip->deleteName('blankimage.jpg'); 
                        }
                    }
                } catch(Exception $e) {
                    if ($counter - $difference < 10) {
                        $zip->addFile($mediaDirectory . "blankimage.jpg", str_replace(' ', '', '0'.($counter - $difference).$myArtwork->name. $name . $mytime . ".jpg"));
                    }
                    $counter++;
                }
            }

            if ($docType == "docx") {
                $zip->addFile($directory ."Documentation.docx", "Documentation.docx"); 
            }
            else if ($docType == "pdf") {
                $zip->addFile($directory. "Documentation.pdf", "Documentation.pdf");
            }
            else if ($docType == 'csv') {
                $zip->addFile($directory. "Documentation.csv", "Documentation.csv");
            }
            else if ($docType == 'xlsx') {
                $zip->addFile($directory. "Documentation.xlsx", "Documentation.xlsx");
            }
        }
        $zip->close();
        return $zipName; 
    }

    public function makeDOCX($name, $artworks, $directory, $options = null, $myProfile = null, $myGroup = null, $url = null) 
    {
        $phpword = new PhpWord;
        $counter = 1; 
        $difference = 0; 
        $section = $phpword->addSection();

        if ($myProfile != null) {
            $textrun = $section->addTextRun();
            $textrun->addText($name, array('name' => 'Arial', 'size' => '11', 'bold' => true));
            $textrun->addText(' , '.$myProfile->pronoun, array('name' => 'Arial', 'size' => '11', 'bold' => false));
            $text = $section->addText($myProfile->ethnicity, array('name' => 'Arial', 'size' => '11', 'bold' => false));
            $text = $section->addText($myProfile->address, array('name' => 'Arial', 'size' => '11', 'bold' => false));
            $text = $section->addText($myProfile->user->email, array('name' => 'Arial', 'size' => '11', 'bold' => false));
            
        } else {
            if ($myGroup != null && ($myGroup->isArtistRunCenterOrganisation())){
                $textrun = $section->addTextRun();
                $textrun->addText($name, array('name' => 'Arial', 'size' => '11', 'bold' => true));
                $text = $section->addText($myGroup->address, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText($myGroup->city, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText($myGroup->country, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText($myGroup->email, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText($myGroup->phone, array('name' => 'Arial', 'size' => '11', 'bold' => false));

        } else {
                if ($myGroup != null) {
                 $textrun = $section->addTextRun();
                 $textrun->addText($name, array('name' => 'Arial', 'size' => '11', 'bold' => true));
                 $text = $section->addText($myGroup->address, array('name' => 'Arial', 'size' => '11', 'bold' => false));

                 // Additional statements specific to $myGroup
             }
            }


        }
    
        $section->addLine(['weight' => 1, 'width' => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(12)), 'height' => 1]);
        foreach ($artworks as $myArtwork) {
            if ($myGroup != null && ($myGroup->isCurator() || $myGroup->isArtistRunCenterOrganisation())){
                $url = '';
            } else if ($myGroup != null) {
                $url = route('app.groups.exhibits.artworks.show', [
                    'group' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,  
                ]);

            } else if ($myProfile != null && $myProfile->isCuratorProfile()) {
                $url = ''; 
            } else if ($myProfile != null) {
                $url = route('app.profiles.exhibits.artworks.show', [
                    'profile' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,
                ]);
            }    
        
        
    
    
            if ($options != null) {
                if (in_array($counter, $options)) {
                    if ($counter - $difference < 10) {
                        $text = $section->addText(str_replace(' ', '', '0'.($counter - $difference).$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4).'.jpg'), array('name' => 'Arial', 'size' => '11', 'bold' => true));
                    } 
                    else if ($counter - $difference >= 10) {
                        $text = $section->addText(str_replace(' ', '', ($counter - $difference).$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4).'.jpg'), array('name' => 'Arial', 'size' => '11', 'bold' => true));
                    }
                    $text = $section->addText("Title/Titre: " . $myArtwork->name, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Description: " . $myArtwork->description, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Medium/Médium: " . $myArtwork->medium, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Dimensions: " . "L: " . $myArtwork->size_lenght . "cm  W: " . $myArtwork->size_width . "cm  H: " . $myArtwork->size_height . " cm", array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Gallery/Galerie: " . $myArtwork->location, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Photographer/Photographe: " . $myArtwork->photographer, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Date: " . substr($myArtwork->date, 0, 10), array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText("Link/Lien: " . $url, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                    $text = $section->addText(); 
                    $text = $section->addText(); 
                    $counter++;
                }
                else{ 
                    $counter++;$difference++;
                }
            }
            else if ($options == null) {
                if ($counter < 10) {
                    $text = $section->addText(str_replace(' ', '', $counter.$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4)), array('name' => 'Arial', 'size' => '11', 'bold' => true));
                } 
                else if ($counter >= 10) {
                    $text = $section->addText(str_replace(' ', '', $counter.$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4)), array('name' => 'Arial', 'size' => '11', 'bold' => true));
                }
                $text = $section->addText("Title/Titre: " . $myArtwork->name, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Description: " . $myArtwork->description, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Medium/Médium: " . $myArtwork->medium, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Dimensions: " . "L: " . $myArtwork->size_lenght . "cm  W: " . $myArtwork->size_width . "cm  H: " . $myArtwork->size_height . " cm", array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Gallery/Galerie: " . $myArtwork->location, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Photographer/Photographe: " . $myArtwork->photographer, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Date: " . substr($myArtwork->date, 0, 10), array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText("Link/Lien: " . $url, array('name' => 'Arial', 'size' => '11', 'bold' => false));
                $text = $section->addText(); 
                $text = $section->addText(); 
                $counter++;
            }
        }
       // $footer = $section->addFooter(); 
       // $footer->addImage(public_path('img/logos/logoIconLightGrey.png'), array('width' => 35, 'height' => 35, 'align' => 'right', 'marginLeft' => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(9.5)),'posHorizontal' => 'absolute','posVertical' => 'absolute'));
        //$footer->addSVG(public_path('img/logos/logoIconLightGrey.svg'), array('width' => 45, 'height' => 25, 'spacingLeft' => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(9.25))));
        $objWriter = IOFactory::createWriter($phpword, 'Word2007');
        $objWriter->save($directory . 'Documentation.docx');
    }


    
    public function makeXLSX($name, $artworks, $directory, $options = null, $myProfile = null, $myGroup = null, $url = null)
    {
        $counter = 1; 
        $difference = 0; 

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(25);

        $row = 1;


        if ($myProfile != null) {
            $sheet->setCellValue('A' . $row, 'Name/Nom:');
            $sheet->setCellValue('B' . ($row++),  $name);
            $sheet->setCellValue('A' . $row, 'Pronoun/Pronom:');
            $sheet->setCellValue('B' . ($row++),  $myProfile->pronoun);
            $sheet->setCellValue('A' . $row, 'Cultural Identity/Identité culturelle:');
            $sheet->setCellValue('B' . ($row++),  $myProfile->ethnicity);
            $sheet->setCellValue('A' . $row, 'Address/Adresse:');
            $sheet->setCellValue('B' . ($row++),  $myProfile->address);
            $sheet->setCellValue('A' . $row, 'Email/Courriel:');
            $sheet->setCellValue('B' . ($row++),  $myProfile->user->email);
            $row =+1;
            //$sheet->setCellValue('A' . $row++, $myProfile->user->email);
        } else if ($myGroup != null && ($myGroup->isArtistRunCenterOrganisation())){

            $sheet->setCellValue('A' . $row, 'Name/Nom:');
            $sheet->setCellValue('B' . ($row++),  $name);
            $sheet->setCellValue('A' . $row, 'Address/Adresse:');
            $sheet->setCellValue('B' . ($row++),  $myGroup->address);
            $sheet->setCellValue('A' . $row, 'City/Ville:');
            $sheet->setCellValue('B' . ($row++),  $myGroup->city);
            $sheet->setCellValue('A' . $row, 'Country/Pays:');
            $sheet->setCellValue('B' . ($row++),  $myGroup->country);
            $sheet->setCellValue('A' . $row, 'Email/Courriel:');
            $sheet->setCellValue('B' . ($row++),  $myGroup->email);
            $sheet->setCellValue('A' . $row, 'Tel:');
            $sheet->setCellValue('B' . ($row++),  $myGroup->phone);

            $row =+1;
         } else if ($myGroup != null) {

            $sheet->setCellValue('A' . $row, 'Name/Nom:');
            $sheet->setCellValue('B' . ($row++),  $name);
            $sheet->setCellValue('A' . $row, 'Address/Adresse:');
            $sheet->setCellValue('B' . ($row++),  $myGroup->address);            // Additional cells specific to $myGroup
            $row =+1;
        } 

        $row +=1;
    
        foreach ($artworks as $myArtwork) {
            if ($myGroup != null && ($myGroup->isCurator() || $myGroup->isArtistRunCenterOrganisation())){
                $url = '';
            } else if ($myGroup != null) {
                $url = route('app.groups.exhibits.artworks.show', [
                    'group' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,  
                ]);

            } else if ($myProfile != null && $myProfile->isCuratorProfile()) {
                $url = ''; 
            } else if ($myProfile != null) {
                $url = route('app.profiles.exhibits.artworks.show', [
                    'profile' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,
                ]);
            }
            $columnA = 'A';
            $columnB = 'B';
            if ($options != null) {
                if (in_array($counter, $options)) {
                    $sheet->setCellValue($columnA . ($row + 6), 'File/Fichier');
                    $sheet->setCellValue($columnA . ($row + 7), 'Title/Titre');
                    $sheet->setCellValue($columnA . ($row + 8), 'Description');
                    $sheet->setCellValue($columnA . ($row + 9), 'Medium/Médium');
                    $sheet->setCellValue($columnA . ($row + 10), 'Dimensions');
                    $sheet->setCellValue($columnA . ($row + 11), 'Gallery/Galerie');
                    $sheet->setCellValue($columnA . ($row + 12), 'Photographer/Photographe');
                    $sheet->setCellValue($columnA . ($row + 13), 'Date');
                    $sheet->setCellValue($columnA . ($row + 14), 'Link/Lien');
                    //$sheet->setCellValue($columnA . ($row + 15),"\n");

                    if ($counter - $difference < 10) {
                        $sheet->setCellValue($columnB . ($row + 6), '0' . ($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg');
                    } else {
                        $sheet->setCellValue($columnB . ($row + 6), ($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg');
                    }
                    $sheet->setCellValue($columnB . ($row + 7), $myArtwork->name);
                    $sheet->setCellValue($columnB . ($row + 8), $myArtwork->description);
                    $sheet->setCellValue($columnB . ($row + 9), $myArtwork->medium);
                    $sheet->setCellValue($columnB . ($row + 10), "L: " . $myArtwork->size_lenght . "cm  W/L: " . $myArtwork->size_width . "cm  H: " . $myArtwork->size_height . " cm");
                    $sheet->setCellValue($columnB . ($row + 11), $myArtwork->location);
                    $sheet->setCellValue($columnB . ($row + 12), $myArtwork->photographer);
                    $sheet->setCellValue($columnB . ($row + 13), substr($myArtwork->date, 0, 10));
                    $sheet->setCellValue($columnB . ($row + 14), $url);
                    //$sheet->setCellValue($columnB . ($row + 15),"\n");
     
                    $row +=10;
                    $counter++;
               } else {
                    $counter++;
                  $difference++;
                }
            } else {
               
                $sheet->setCellValue($columnA . ($row + 6), 'File/Fichier'); 
                $sheet->setCellValue($columnA . ($row + 7), 'Title/Titre');
                $sheet->setCellValue($columnA . ($row + 8), 'Description');
                $sheet->setCellValue($columnA . ($row + 9), 'Medium/Médium');
                $sheet->setCellValue($columnA . ($row + 10), 'Dimensions');
                $sheet->setCellValue($columnA . ($row + 11), 'Gallery/Galerie');
                $sheet->setCellValue($columnA . ($row + 12), 'Photographer/Photographe');
                $sheet->setCellValue($columnA . ($row + 13), 'Date');
                $sheet->setCellValue($columnA . ($row + 14), 'Link/Lien');
               // $sheet->setCellValue($columnA . ($row + 15),"\n");

                if ($counter - $difference < 10) {
                    $sheet->setCellValue($columnB . ($row + 6), '0' . ($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg');
                } else {
                    $sheet->setCellValue($columnB . ($row + 6), ($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg');
                }
                $sheet->setCellValue($columnB . ($row + 7), $myArtwork->name);
                $sheet->setCellValue($columnB . ($row + 8), $myArtwork->description);
                $sheet->setCellValue($columnB . ($row + 9), $myArtwork->medium);
                $sheet->setCellValue($columnB . ($row + 10), "L: " . $myArtwork->size_lenght . "cm  W/L: " . $myArtwork->size_width . "cm  H: " . $myArtwork->size_height . " cm");
                $sheet->setCellValue($columnB . ($row + 11), $myArtwork->location);
                $sheet->setCellValue($columnB . ($row + 12), $myArtwork->photographer);
                $sheet->setCellValue($columnB . ($row + 13), substr($myArtwork->date, 0, 10));
                $sheet->setCellValue($columnB . ($row + 14), $url);
               // $sheet->setCellValue($columnB . ($row + 15),"\n");

 
               $row +=10;
                $counter++;
            }
    
        }
        for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
        }
    
        $writer = new Xlsx($spreadsheet);
        $writer->save($directory . 'Documentation.xlsx');
    }

    public function makeCSV($artworks, $name, $directory, $options = null, $myProfile = null, $myGroup = null, $url = null)
    {
        $counter = 1;
        $difference = 0;
        $handle = fopen($directory . 'Documentation.csv', 'w');
        $rowsA = []; // Column A - Labels
        $rowsB = []; // Column B - Values
    
        if ($myProfile != null) {
            array_push($rowsA, ['Name/Nom:']);
            array_push($rowsA, ['Pronoun/Pronom:']);
            array_push($rowsA, ['Cultural Identity/Identité culturelle:']);
            array_push($rowsA, ['Address/Adresse:']);
            array_push($rowsA, ['Email/Courriel:']);
    
            array_push($rowsB, [$name]);
            array_push($rowsB, [$myProfile->pronoun]);
            array_push($rowsB, [$myProfile->ethnicity]);
            array_push($rowsB, [$myProfile->address]);
            array_push($rowsB, [$myProfile->user->email]);
        } else if ($myGroup != null && $myGroup->isArtistRunCenterOrganisation()) {
            array_push($rowsA, ['Name/Nom:']);
            array_push($rowsA, ['Address/Adresse:']);
            array_push($rowsA, ['City/Ville:']);
            array_push($rowsA, ['Country/Pays:']);
            array_push($rowsA, ['Email/Courriel:']);
            array_push($rowsA, ['Tel:']);
    
            array_push($rowsB, [$name]);
            array_push($rowsB, [$myGroup->address]);
            array_push($rowsB, [$myGroup->city]);
            array_push($rowsB, [$myGroup->country]);
            array_push($rowsB, [$myGroup->email]);
            array_push($rowsB, [$myGroup->phone]);
        } else if ($myGroup != null) {
            array_push($rowsA, ['Name/Nom:']);
            array_push($rowsA, ['Address/Adresse:']);
    
            array_push($rowsB, [$name]);
            array_push($rowsB, [$myGroup->address]);
        }
    
        array_push($rowsA, ['']);
        array_push($rowsB, ['']);
    
        foreach ($artworks as $myArtwork) {
            if ($myGroup != null && ($myGroup->isCurator() || $myGroup->isArtistRunCenterOrganisation())) {
                $url = '';
            } else if ($myGroup != null) {
                $url = route('app.groups.exhibits.artworks.show', [
                    'group' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,
                ]);
            } else if ($myProfile != null && $myProfile->isCuratorProfile()) {
                $url = '';
            } else if ($myProfile != null) {
                $url = route('app.profiles.exhibits.artworks.show', [
                    'profile' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,
                ]);
            }
    
            if ($options != null) {
                if (in_array($counter, $options)) {
                    array_push($rowsA, ['File/Fichier']);
                    array_push($rowsA, ['Title/Titre']);
                    array_push($rowsA, ['Description']);
                    array_push($rowsA, ['Medium/Médium']);
                    array_push($rowsA, ['Dimensions']);
                    array_push($rowsA, ['Gallery/Galerie']);
                    array_push($rowsA, ['Photographer/Photographe']);
                    array_push($rowsA, ['Date']);
                    array_push($rowsA, ['Link/Lien']);
                    array_push($rowsA, ['']);
    
                    if ($counter - $difference < 10) {
                        array_push($rowsB, ['0' . ($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg']);
                    } else {
                        array_push($rowsB, [($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg']);
                    }
                    array_push($rowsB, [$myArtwork->name]);
                    array_push($rowsB, [$myArtwork->description]);
                    array_push($rowsB, [$myArtwork->medium]);
                    array_push($rowsB, ["L: " . $myArtwork->size_lenght . "cm  W/L: " . $myArtwork->size_width . "cm  H: " . $myArtwork->size_height . " cm"]);
                    array_push($rowsB, [$myArtwork->location]);
                    array_push($rowsB, [$myArtwork->photographer]);
                    array_push($rowsB, [substr($myArtwork->date, 0, 10)]);
                    array_push($rowsB, [$url]);
                    array_push($rowsB, ['']);

    
                    $counter++;
                } else {
                    $counter++;
                    $difference++;
                }
            } else {
                array_push($rowsA, ['File/Fichier']);
                array_push($rowsA, ['Title/Titre']);
                array_push($rowsA, ['Description']);
                array_push($rowsA, ['Medium/Médium']);
                array_push($rowsA, ['Dimensions']);
                array_push($rowsA, ['Gallery/Galerie']);
                array_push($rowsA, ['Photographer/Photographe']);
                array_push($rowsA, ['Date']);
                array_push($rowsA, ['Link/Lien']);
                array_push($rowsA, ['']);

    
                if ($counter - $difference < 10) {
                    array_push($rowsB, ['0' . ($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg']);
                } else {
                    array_push($rowsB, [($counter - $difference) . $myArtwork->name . $name . substr(Carbon::now()->toDateTimeString(), 0, 4) . '.jpg']);
                }
                array_push($rowsB, [$myArtwork->name]);
                array_push($rowsB, [$myArtwork->description]);
                array_push($rowsB, [$myArtwork->medium]);
                array_push($rowsB, ["L: " . $myArtwork->size_lenght . "cm  W/L: " . $myArtwork->size_width . "cm  H: " . $myArtwork->size_height . " cm"]);
                array_push($rowsB, [$myArtwork->location]);
                array_push($rowsB, [$myArtwork->photographer]);
                array_push($rowsB, [substr($myArtwork->date, 0, 10)]);
                array_push($rowsB, [$url]);
                array_push($rowsB, ['']);

            
    
                $counter++;
            }
        }
    
        // Merge column A and column B arrays
        $mergedRows = array_map(null, $rowsA, $rowsB);

        foreach ($mergedRows as $row) {
            $row = array_map(function ($value) {
                return is_array($value) ? implode(',', $value) : strval($value);
            }, $row);
            fputcsv($handle, $row);
        }

    fclose($handle);
}
    public function makePDF( $artworks, $name, $options = null, $myProfile = null, $myGroup = null, $url = null)
{
        $counter= 1; 
        $difference = 0; 
        $html = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Documentation</title>
                <style>
                    html *{
                        font-family: Arial, Helvetica, sans-serif;
                    }
                </style>
            </head>
            <body>';
           
            if ($myProfile != null) {
                $html .= "<h4 style=\"display:inline;font-size:16px;\">$name, </h4><p style=\"display:inline;\">{$myProfile->pronoun}</p>" .
                    "<p>{$myProfile->ethnicity}</p><p>{$myProfile->address}</p><p>{$myProfile->user->email}</p>";
            } else if ($myGroup != null && ($myGroup->isArtistRunCenterOrganisation())) {
                $html .= "<h4 style=\"display:inline;font-size:16px;\">$name, </h4><p style=\"display:inline;\">" .
                    "<p>{$myGroup->address}</p><p>{$myGroup->city}</p><p>{$myGroup->country}</p><p>{$myGroup->email}</p><p>{$myGroup->phone}</p>";
            } else if ($myGroup != null) {
                $html .= "<h4 style=\"display:inline;font-size:16px;\">$name, </h4><p style=\"display:inline;\">" .
                    "<p>{$myGroup->address}</p>";
            }
            $html .= '<hr/>';
        foreach($artworks as $myArtwork){
            if ($myGroup != null && ($myGroup->isCurator() || $myGroup->isArtistRunCenterOrganisation())){
                $url = '';
            } else if ($myGroup != null) {
                $url = route('app.groups.exhibits.artworks.show', [
                    'group' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,  
                ]);

            } else if ($myProfile != null && $myProfile->isCuratorProfile()) {
                $url = ''; 
            } else if ($myProfile != null) {
                $url = route('app.profiles.exhibits.artworks.show', [
                    'profile' => $myArtwork->exhibit->owner_id,
                    'exhibit' => $myArtwork->exhibit_id,
                    'artwork' => $myArtwork->id,
                ]);
            } 

             
            if($options != null){
                if(in_array($counter, $options)){
                    if(($counter - $difference) > 2 && ($counter - $difference) % 2 == 1){
                        $html .= "<p></p><p></p><p></p><p></p><p></p>";
                    }
                    if($counter - $difference < 10){
                        $html .= '
                            <h4 style="font-size:16px;"> 0'.str_replace(' ', '', ($counter - $difference).$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4)).".jpg </h4>";
                    }
                    else if($counter - $difference >= 10){
                        $html .= "
                            <h4>".str_replace(' ', '', ($counter - $difference).$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4)).".jpg</h4>";
                    } 
                    $html .= "    
                            <p>Title/Titre :  $myArtwork->name </p>
                            <p>Description :  $myArtwork->description </p>
                            <p>Medium/Médium :  $myArtwork->medium </p>
                            <p>Dimensions : L:  $myArtwork->size_lenght cm W: $myArtwork->size_width cm H: $myArtwork->size_height</p>
                            <p>Gallery/Galerie :  $myArtwork->location </p>
                            <p>Photographer/Photographe :  $myArtwork->photographer </p>
                            <p>Date :  $myArtwork->date </p>
                            <p>Link/Lien :  $url</p>
                            <br/>
                        ";
                    
                    
                        
                      /*  if(($counter - $difference) % 2 == 0 || ($counter - $difference) == (count($artworks) - $difference)){
                            $html .= '
                            <footer>
                            <img src="'.public_path("/img/logos/logoIconLightGrey.svg").'" width="50" height="50" style="margin-left:85%;margin-top:20%;">
                            </footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                        }*/
                        $counter++; 
                    }
                
                else{$counter++;$difference++;}
                
            }
        
            else if($options == null){
                if(($counter) > 2 && ($counter) % 2 == 1){
                    $html .= "<p></p><p></p><p></p><p></p><p></p>";
                }
                if($counter < 10){
                    $html .= "
                    <h4>0".str_replace(' ', '', ($counter - $difference).$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4)).".jpg</h4>";
                }
                else if($counter >= 10){
                    $html .= "
                    <h4>".str_replace(' ', '', ($counter - $difference).$myArtwork->name.$name.substr(Carbon::now()->toDateTimeString(), 0, 4)).".jpg</h4>";
                }    
                $html .= "
                        <p>Title/Titre :  $myArtwork->name </p>
                        <p>Description :  $myArtwork->description </p>
                        <p>Medium/Médium:  $myArtwork->medium </p>
                        <p>Dimensions : L:  $myArtwork->size_lenght cm W: $myArtwork->size_width cm H: $myArtwork->size_height</p>
                        <p>Gallery/Galerie :  $myArtwork->location </p>
                        <p>Photographer/Photographe :  $myArtwork->photographer </p>
                        <p>Date :  $myArtwork->date </p>
                        <p>Link/Lien :  $url</p>
                        <br/>
                    ";
                
                if($counter % 2 == 0  || $counter == count($artworks) && count($artworks) != 1){
                   /* if($myProfile != null){
                        $html .= '
                        <footer>
                        <img src="'.public_path("/img/logos/logoIconLightGrey.svg").'" width="50" height="50" style="margin-left:85%;margin-top:5%;">
                        </footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                        }
                    else{
                        $html .='
                        <footer>
                        <img src="'.public_path("/img/logos/logoIconLightGrey.svg").'" width="50" height="50" style="margin-left:85%;margin-top:20%;">
                        </footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                    }*/
                }
               /* else if(count($artworks) == 1){
                    if($myProfile != null){
                        $html .= '
                        <footer>
                        <img src="'.public_path("/img/logos/logoIconLightGrey.svg").'" width="50" height="50" style="margin-left:85%;margin-top:60%;">
                        </footer>';
                    }
                    else{
                        $html .= '
                        <footer>
                        <img src="'.public_path("/img/logos/logoIconLightGrey.svg").'" width="50" height="50" style="margin-left:85%;margin-top:80%;">
                        </footer>';
                    }
                }*/
                    $counter++;
                }
            
            
        }
        $html .= '
            </body>
            
            </html>
        ';
        $pdf = FacadePdf::loadHTML($html);
        Storage::put('public/Documentation.pdf', $pdf->output());
    }


    public function directoryCheck($directory, $mediaDirectory)
    {
        //creat a blank image if it doesn't already exist, only really necessary once.
        if(!file_exists("C:/xampp/htdocs/Artolog/public/media/blankimage.jpg")){
            $image = imagecreate(200,200);
            imagejpeg($image, $mediaDirectory. 'blankimage.jpg');
            imagedestroy($image);
        }
        //make sure that the storage directories exist 
        $directories = ['docx', 'pdf', 'xlsx', 'csv'];
        foreach($directories as $d)
        if (!file_exists($directory .$d)) {
            mkdir($directory. $d, 0777, true);
        }
    }
}
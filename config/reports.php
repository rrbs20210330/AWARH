<?php 
require('fpdf.php');
require("db.php");
class Report extends FPDF{
    function Header(){
        $this->SetFont('Arial','B',8);
        $this->setXY(150,10);
        $this->cell(10, 2,'Universidad Teconologica de Manzanillo', 4, 3, 'c', 0);
        $this->setXY(156,13);
        $this->cell(10, 2,utf8_decode(' Camino hacías las humedades S/N, '), 4, 3, 'c', 0);
        $this->setXY(155,16);
        $this->cell(10, 2,utf8_decode(' Salagua, Manzanillo, Colima, México'), 4, 3, 'c', 0);
        $this->setXY(176,19);
        $this->cell(10, 2,' utem@utem.edu.mx  ', 4, 3, 'c', 0);
        $this->setXY(180,22);
        $this->cell(10, 2,utf8_decode(' 01 (314) 33 14450 '), 4, 3, 'c', 0);
        // Logo
        $this->Image('../assets/img/utem_logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetLineWidth(2);
        $this->SetDrawColor(58,180,152);
        $this->Line(200,30,8,30);
        // $this->Cell(30,10,'Resumen - Listado de Empleados ',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        
    }

    // Pie de página
    function Footer(){
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().' / {nb}',0,0,'C');
    }

    function GenerateReportAllAnnouncements(){
        $DataBase = new db();
        //Create new pdf file
        
        //Disable automatic page break
        // $this->SetAutoPageBreak(false);
        $list_announcements = $DataBase->read_data_table('announcements');
        if(!$list_announcements || $list_announcements->num_rows == 0){
            return null;
        }
        //Add first page
        $this->AddPage();
        
        //set initial y axis position per page
        $y_initial = 35;
        $x_initial = 5;
        $row_height = 6;
        $i = 0;
        
        //Set maximum rows per page
        $max = 30;
        
        //Set Row Height
        $row_height_table = $y_initial+$row_height;
        $y_actual = $row_height_table;
        //print column titles
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,'Listado de convocatorias',0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $y_actual += ($row_height_table-$y_initial);
        
        $this->Cell(87,$row_height,'Nombre Completo',1,0,'L',1);
        $this->Cell(33,$row_height,'Estado',1,0,'C',1);
        $this->Cell(80,$row_height,'Fechas Inicio - Termino',1,0,'C',1); 
        
        
        
        //Select the Products you want to show in your PDF file
        
        
        //initialize counter
        
        
        
        while ($row = mysqli_fetch_object($list_announcements)) {
            $id = $row->id_announcement;
            $fullname = $row->t_name;
            $email = $row->d_dates;
            $phone_number = $row->b_active ? "Activo" : "Inactivo";
            //If the current row is the last one, create new page and print column title
            if ($i == $max)
            {
                $this->AddPage();
        
                //print column titles for the current page
                $this->SetY($y_initial);
                $this->SetX($x_initial);
                $this->Cell(87,$row_height,'Nombre Completo',1,0,'L',1);
                $this->Cell(33,$row_height,'Estado',1,0,'C',1);
                $this->Cell(80,$row_height,'Fechas Inicio - Termino',1,0,'C',1);
                
                
                //Go to next row
                $y_actual = $row_height_table-$row_height;
                $y_actual += ($row_height_table-$y_initial);
                
                //Set $i variable to 0 (first row)
                $i = 0;
            }
        
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            
            $this->Cell(87,$row_height,$fullname,1,0,'L',1);
            $this->Cell(33,$row_height,$phone_number,1,0,'C',1);
            $this->Cell(80,$row_height,$email,1,0,'C',1);
        
            //Go to next row
            $y_actual += ($row_height_table-$y_initial);
            $i = $i + 1;
        }
        $list_announcements2 = $DataBase->read_data_table('announcements');
        $contador = 0;
        while ($row = mysqli_fetch_object($list_announcements2)) {
            $contador += 1;
            $id = $row->id_announcement;
            $info_announcement_v = $DataBase->read_single_record_announcement_report($id);
            if(!$info_announcement_v || $info_announcement_v->num_rows == 0){
                return null;
            }
            $info_announcement = mysqli_fetch_object($info_announcement_v);
            
            //Add first page
            $this->AddPage();
            
            //set initial y axis position per page
            $y_initial = 35;
            $x_initial = 5;
            $row_height = 6;
            //print column titles¿
            
            //Set Row Height
            $row_height_table = $y_initial+$row_height;
            $y_actual = $row_height_table;
            //Seccion, Reporte General Por empleado
            
            $this->SetFillColor(255,255,255);
            $this->SetFont('Arial','B',12);
            $id = $info_announcement->id_announcement;
            $name = $info_announcement->t_name;
            $descripcion = $info_announcement->t_description;
            $status = $info_announcement->b_active ? "Activa" : "Inactiva";
            $dates = $info_announcement->d_dates;
            $process = $info_announcement->t_process;
            $profile = $info_announcement->t_profile;
            $functions = $info_announcement->t_functions;
            $path_p = $DataBase->read_single_record_files($info_announcement->fk_file)->t_path;
            $count = $DataBase->count_data_announcements_employees($id)->contador; 
            $this->SetY($y_initial);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Reporte de Convocatoria - No. $contador",0,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Informacion General",1,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $rows_static_info_general = array('Nombre', 'Fecha de Inicio - Final','Estado','Cantidad de Aspirantes');
            $rows_dynamic_info_general = array("$name","$dates","$status", "$count");
            
            for ($a = 0; $a <= count($rows_static_info_general)-1; $a++) {
                $this->SetY($y_actual);
                $this->SetX($x_initial);
                $this->Cell(70,$row_height,"$rows_static_info_general[$a]",1);
                $this->Cell(130,$row_height,"$rows_dynamic_info_general[$a]",1);
                $y_actual += ($row_height_table-$y_initial);
            }
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(50,$row_height,"Descripcion",1,0,"C");
            $this->Cell(50,$row_height,"Funciones",1,0,"C");
            $this->Cell(50,$row_height,"Process",1,0,"C");
            $this->Cell(50,$row_height,"Perfil",1,0,"C");
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->MultiCell(50,$row_height,"$descripcion",1);
            $this->SetY($y_actual);
            $this->SetX($x_initial+50);
            $this->MultiCell(50,$row_height,"$functions",1);
            $this->SetY($y_actual);
            $this->SetX($x_initial+100);
            $this->MultiCell(50,$row_height,"$process",1);
            $this->SetY($y_actual);
            $this->SetX($x_initial+150);
            $this->MultiCell(50,$row_height,"$profile",1);
        }

        $this->AliasNbPages();
        $this->Output();
    }
    function GenerateReportAnnouncement($id){
        $DataBase = new db();
        //Select the Products you want to show in your PDF file
        $this->SetAutoPageBreak(true);
        $info_announcement_v = $DataBase->read_single_record_announcement_report($id);
        if(!$info_announcement_v || $info_announcement_v->num_rows == 0){
            return null;
        }
        $info_announcement = mysqli_fetch_object($info_announcement_v);
        //Add first page
        $this->AddPage();
        
        //set initial y axis position per page
        $y_initial = 35;
        $x_initial = 5;
        $row_height = 6;
        //print column titles¿
        
        //Set Row Height
        $row_height_table = $y_initial+$row_height;
        $y_actual = $row_height_table;
        //Seccion, Reporte General Por empleado
        
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $id = $info_announcement->id_announcement;
        $name = $info_announcement->t_name;
        $descripcion = $info_announcement->t_description;
        $status = $info_announcement->b_active ? "Activa" : "Inactiva";
        $dates = $info_announcement->d_dates;
        $process = $info_announcement->t_process;
        $profile = $info_announcement->t_profile;
        $functions = $info_announcement->t_functions;
        $path_p = $DataBase->read_single_record_files($info_announcement->fk_file)->t_path;
        $count = $DataBase->count_data_announcements_employees($id)->contador; 
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Reporte de Convocatoria",0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Informacion General",1,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $rows_static_info_general = array('Nombre', 'Fecha de Inicio - Final','Estado','Cantidad de Aspirantes');
        $rows_dynamic_info_general = array("$name","$dates","$status", "$count");
        
        for ($a = 0; $a <= count($rows_static_info_general)-1; $a++) {
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(70,$row_height,"$rows_static_info_general[$a]",1);
            $this->Cell(130,$row_height,"$rows_dynamic_info_general[$a]",1);
            $y_actual += ($row_height_table-$y_initial);
        }
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(50,$row_height,"Descripcion",1,0,"C");
        $this->Cell(50,$row_height,"Funciones",1,0,"C");
        $this->Cell(50,$row_height,"Process",1,0,"C");
        $this->Cell(50,$row_height,"Perfil",1,0,"C");
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->MultiCell(50,$row_height,"$descripcion",1);
        $this->SetY($y_actual);
        $this->SetX($x_initial+50);
        $this->MultiCell(50,$row_height,"$functions",1);
        $this->SetY($y_actual);
        $this->SetX($x_initial+100);
        $this->MultiCell(50,$row_height,"$process",1);
        $this->SetY($y_actual);
        $this->SetX($x_initial+150);
        $this->MultiCell(50,$row_height,"$profile",1);
        
        
        $this->AliasNbPages();
        //Send file
        $this->Output();
    }
    function GenerateReportAllCandidates(){
        $DataBase = new db();
        //Create new pdf file
        
        //Disable automatic page break
        // $this->SetAutoPageBreak(false);
        $list_candidates = $DataBase->read_data_table('candidates');
        if(!$list_candidates || $list_candidates->num_rows == 0){
            return null;
        }
        //Add first page
        $this->AddPage();
        
        //set initial y axis position per page
        $y_initial = 35;
        $x_initial = 5;
        $row_height = 6;
        $i = 0;
        
        //Set maximum rows per page
        $max = 30;
        
        //Set Row Height
        $row_height_table = $y_initial+$row_height;
        $y_actual = $row_height_table;
        //print column titles
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,'Listado de Candidatos',0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $y_actual += ($row_height_table-$y_initial);
        
        $this->Cell(77,$row_height,'Nombre Completo',1,0,'L',1);
        $this->Cell(28,$row_height,'Telefono',1,0,'C',1);
        $this->Cell(70,$row_height,'Correo Electronico',1,0,'L',1); 
        
        
        
        //Select the Products you want to show in your PDF file
        
        
        //initialize counter
        
        
        
        while ($row = mysqli_fetch_object($list_candidates)) {
            $id = $row->id_candidate;
            $fullname = $row->t_name;
            $email = $row->t_email;
            $phone_number = $row->t_phone_number;
            //If the current row is the last one, create new page and print column title
            if ($i == $max)
            {
                $this->AddPage();
        
                //print column titles for the current page
                $this->SetY($y_initial);
                $this->SetX($x_initial);
                $this->Cell(77,$row_height,'Nombre Completo',1,0,'L',1);
                $this->Cell(28,$row_height,'Telefono',1,0,'C',1);
                $this->Cell(70,$row_height,'Correo Electronico',1,0,'R',1);
                
                
                //Go to next row
                $y_actual = $row_height_table-$row_height;
                $y_actual += ($row_height_table-$y_initial);
                
                //Set $i variable to 0 (first row)
                $i = 0;
            }
        
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            
            $this->Cell(77,$row_height,$fullname,1,0,'L',1);
            $this->Cell(28,$row_height,$phone_number,1,0,'C',1);
            $this->Cell(70,$row_height,$email,1,0,'L',1);
        
            //Go to next row
            $y_actual += ($row_height_table-$y_initial);
            $i = $i + 1;
        }

        $list_candidates2 = $DataBase->read_data_table('candidates');
        $cont = 0;
        while ($row = mysqli_fetch_object($list_candidates2)) {
            $id = $row->id_candidate;
            $cont += 1;
            $info_candidate_v = $DataBase->read_single_record_candidates_report($id);
            if(!$info_candidate_v || $info_candidate_v->num_rows == 0){
                return null;
            }
            $info_candidate = mysqli_fetch_object($info_candidate_v);
            //Add first page
            $this->AddPage();
            
            //set initial y axis position per page
            $y_initial = 35;
            $x_initial = 5;
            $row_height = 6;
            //print column titles¿
            
            //Set Row Height
            $row_height_table = $y_initial+$row_height;
            $y_actual = $row_height_table;
            //Seccion, Reporte General Por empleado
            
            $this->SetFillColor(255,255,255);
            $this->SetFont('Arial','B',12);
            $id = $info_candidate->id_candidate;
            $fullname = $info_candidate->t_name;
            $email = $info_candidate->t_email;
            $phone_number = $info_candidate->t_phone_number;
            $appointment_date = $info_candidate->dt_appointment_date;
            $perfil  = $info_candidate->t_profile;
            $request_position_id = $DataBase->read_single_record_candidates_position($id) ? $DataBase->read_single_record_candidates_position($id)->fk_position : 0;
            $request_position_name = $DataBase->read_single_record_position($request_position_id) ? $DataBase->read_single_record_position($request_position_id)->t_name : "No seleccionado";
            $path_p = $DataBase->read_single_record_files($info_candidate->fk_cv)->t_path;
            $count = $DataBase->count_data_training($id) ? $DataBase->count_data_training($id)->count_data : 0; 
            $this->SetY($y_initial);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Reporte de Candidato $cont",0,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Informacion General",1,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $rows_static_info_general = array('Nombre Completo', 'Email','Telefono','Fecha y Hora de Cita','Puesto solicitado');
            $rows_dynamic_info_general = array("$fullname","$email","$phone_number","$appointment_date","$request_position_name");
            
            for ($a = 0; $a <= count($rows_static_info_general)-1; $a++) {
                $this->SetY($y_actual);
                $this->SetX($x_initial);
                $this->Cell(70,$row_height,"$rows_static_info_general[$a]",1);
                $this->Cell(130,$row_height,"$rows_dynamic_info_general[$a]",1);
                $y_actual += ($row_height_table-$y_initial);
            }
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Perfil",1,0,"C");
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->MultiCell(200,$row_height,"$perfil",1);
        }
        $this->AliasNbPages();
        //Send file
        $this->Output();
    }
    function GenerateReportCandidate($id){
        $DataBase = new db();
        //Select the Products you want to show in your PDF file
        $this->SetAutoPageBreak(true);
        $info_candidate_v = $DataBase->read_single_record_candidates_report($id);
        if(!$info_candidate_v || $info_candidate_v->num_rows == 0){
            return null;
        }
        $info_candidate = mysqli_fetch_object($info_candidate_v);
        //Add first page
        $this->AddPage();
        
        //set initial y axis position per page
        $y_initial = 35;
        $x_initial = 5;
        $row_height = 6;
        //print column titles¿
        
        //Set Row Height
        $row_height_table = $y_initial+$row_height;
        $y_actual = $row_height_table;
        //Seccion, Reporte General Por empleado
        
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $id = $info_candidate->id_candidate;
        $fullname = $info_candidate->t_name;
        $email = $info_candidate->t_email;
        $phone_number = $info_candidate->t_phone_number;
        $appointment_date = $info_candidate->dt_appointment_date;
        $perfil  = $info_candidate->t_profile;
        $request_position_id = $DataBase->read_single_record_candidates_position($id) ? $DataBase->read_single_record_candidates_position($id)->fk_position : 0;
        $request_position_name = $DataBase->read_single_record_position($request_position_id) ? $DataBase->read_single_record_position($request_position_id)->t_name : "No seleccionado";
        $path_p = $DataBase->read_single_record_files($info_candidate->fk_cv)->t_path;
        $count = $DataBase->count_data_training($id) ? $DataBase->count_data_training($id)->count_data : 0; 
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Reporte de Candidato",0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Informacion General",1,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $rows_static_info_general = array('Nombre Completo', 'Email','Telefono','Fecha y Hora de Cita','Puesto solicitado');
        $rows_dynamic_info_general = array("$fullname","$email","$phone_number","$appointment_date","$request_position_name");
        
        for ($a = 0; $a <= count($rows_static_info_general)-1; $a++) {
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(70,$row_height,"$rows_static_info_general[$a]",1);
            $this->Cell(130,$row_height,"$rows_dynamic_info_general[$a]",1);
            $y_actual += ($row_height_table-$y_initial);
        }
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Perfil",1,0,"C");
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->MultiCell(200,$row_height,"$perfil",1);
        $this->AliasNbPages();
        //Send file
        $this->Output();
    }
    function GenerateReportAllEmployees(){
        $DataBase = new db();
        //Create new pdf file
        
        //Disable automatic page break
        // $this->SetAutoPageBreak(false);
        $list_employees = $DataBase->read_all_employees();
        if(!$list_employees || $list_employees->num_rows == 0){
            return null;
        }
        //Add first page
        $this->AddPage();
        
        //set initial y axis position per page
        $y_initial = 35;
        $x_initial = 5;
        $row_height = 6;
        $i = 0;
        
        //Set maximum rows per page
        $max = 30;
        
        //Set Row Height
        $row_height_table = $y_initial+$row_height;
        $y_actual = $row_height_table;
        //print column titles
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,'Listado de Empleados',0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $y_actual += ($row_height_table-$y_initial);
        $this->Cell(25,$row_height,'No.Control',1,0,'C',1);
        $this->Cell(77,$row_height,'Nombre Completo',1,0,'L',1);
        $this->Cell(28,$row_height,'Telefono',1,0,'C',1);
        $this->Cell(70,$row_height,'Correo Electronico',1,0,'L',1);
        
        
        
        //Select the Products you want to show in your PDF file
        
        
        //initialize counter
        
        
        
        while ($row = mysqli_fetch_object($list_employees)) {
            $id = $row->id_employee;
            $fullname = $row->t_names." ".$row->t_last_names;
            $email = $row->t_email;
            $phone_number = $row->t_phone_number;
            //If the current row is the last one, create new page and print column title
            if ($i == $max)
            {
                $this->AddPage();
        
                //print column titles for the current page
                $this->SetY($y_initial);
                $this->SetX($x_initial);
                $this->Cell(25,$row_height,'No.Control',1,0,'C',1);
                $this->Cell(77,$row_height,'Nombre Completo',1,0,'L',1);
                $this->Cell(28,$row_height,'Telefono',1,0,'C',1);
                $this->Cell(70,$row_height,'Correo Electronico',1,0,'R',1);
                
                
                //Go to next row
                $y_actual = $row_height_table-$row_height;
                $y_actual += ($row_height_table-$y_initial);
                
                //Set $i variable to 0 (first row)
                $i = 0;
            }
        
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(25,$row_height,$id,1,0,'C',1);
            $this->Cell(77,$row_height,$fullname,1,0,'L',1);
            $this->Cell(28,$row_height,$phone_number,1,0,'C',1);
            $this->Cell(70,$row_height,$email,1,0,'L',1);
        
            //Go to next row
            $y_actual += ($row_height_table-$y_initial);
            $i = $i + 1;
        }

        //Seccion, Reporte General Por empleado
        $single_info_employees = $DataBase->read_all_employees_info();
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        
        while ($row = mysqli_fetch_object($single_info_employees)) {
            $this->AddPage();
            $y_actual = $row_height_table;
            $id = $row->id_employee;
            $fullname = $row->t_names." ".$row->t_last_names;
            $email = $row->t_email;
            $phone_number = $row->t_phone_number;
            $rfc = $row->t_rfc;
            $nss = $row->t_nss;
            $birthday = $row->d_birthday;
            $no_interior = $row->t_no_interior;
            $no_exterior = $row->t_no_exterior;
            $references = $row->t_references;
            $street = $row->t_street;
            $colony = $row->t_colony;
            $puesto = $row->fk_position === null ? "Ninguno" : ($DataBase->read_single_record_position($row->fk_position)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_position($row->fk_position)->t_name);
            $cargo = $row->fk_charge === null ? "Ninguno" : ($DataBase->read_single_record_charges($row->fk_charge)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_charges($row->fk_charge)->t_name);
            $id_area = $row->fk_position == null ? null : ($DataBase->read_single_record_area_position($row->fk_position) ? $DataBase->read_single_record_area_position($row->fk_position)->fk_area : null);
            $area = $id_area == null ? "Ninguna" : $DataBase->read_single_record_area($id_area)->t_name;
            $path_p = $DataBase->read_single_record_files($row->fk_img)->t_path;
            $count = $DataBase->count_data_training($id) ? $DataBase->count_data_training($id)->count_data : 0; 
            $this->SetY($y_initial);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Reporte General de Empleado | No. Control $id",0,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Informacion General",1,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $rows_static_info_general = array('Nombre Completo', 'Email','RFC','NSS','Telefono','Fecha de Nacimiento');
            $rows_dynamic_info_general = array("$fullname","$email","$rfc","$nss","$phone_number","$birthday");
            for ($a = 0; $a <= count($rows_static_info_general)-1; $a++) {
                $this->SetY($y_actual);
                $this->SetX($x_initial);
                $this->Cell(70,$row_height,"$rows_static_info_general[$a]",1);
                $this->Cell(130,$row_height,"$rows_dynamic_info_general[$a]",1);
                $y_actual += ($row_height_table-$y_initial);
            }
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Informacion de Domicilio",1,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $rows_static_info_residence = array('Colonia', 'Calle','No. Exterior','No. Interior','Referencias');
            $rows_dynamic_info_residence = array("$colony","$street","$no_exterior","$no_interior","$references");
            for ($a = 0; $a <= count($rows_static_info_residence)-1; $a++) {
                $this->SetY($y_actual);
                $this->SetX($x_initial);
                $this->Cell(70,$row_height,"$rows_static_info_residence[$a]",1);
                $this->Cell(130,$row_height,"$rows_dynamic_info_residence[$a]",1);
                $y_actual += ($row_height_table-$y_initial);
            }
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Informacion de Trabajo",1,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $rows_static_info_residence = array('Puesto', 'Cargo','Area','No. Capacitaciones');
            $rows_dynamic_info_residence = array("$puesto","$cargo","$area","$count");
            for ($a = 0; $a <= count($rows_static_info_residence)-1; $a++) {
                $this->SetY($y_actual);
                $this->SetX($x_initial);
                $this->Cell(70,$row_height,"$rows_static_info_residence[$a]",1);
                $this->Cell(130,$row_height,"$rows_dynamic_info_residence[$a]",1);
                $y_actual += ($row_height_table-$y_initial);
            }
        }
        $this->AliasNbPages();
        //Send file
        $this->Output();
    }
    function GenerateReportEmployee($id){
        $DataBase = new db();
        //Select the Products you want to show in your PDF file
        $this->SetAutoPageBreak(true);
        $info_employee_t = $DataBase->read_info_employee_Report($id);
        if(!$info_employee_t || $info_employee_t->num_rows == 0){
            return null;
        }
        $info_employee = mysqli_fetch_object($info_employee_t);
        
        //Add first page
        $this->AddPage();
        
        //set initial y axis position per page
        $y_initial = 35;
        $x_initial = 5;
        $row_height = 6;
        //print column titles¿
        
        
        
        //initialize counter
        $i = 0;
        
        //Set maximum rows per page
        $max = 30;
        
        //Set Row Height
        $row_height_table = $y_initial+$row_height;
        $y_actual = $row_height_table;
        //Seccion, Reporte General Por empleado
        
        $this->SetFillColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $id = $info_employee->id_employee;
        $fullname = $info_employee->t_names." ".$info_employee->t_last_names;
        $email = $info_employee->t_email;
        $phone_number = $info_employee->t_phone_number;
        $rfc = $info_employee->t_rfc;
        $nss = $info_employee->t_nss;
        $birthday = $info_employee->d_birthday;
        $no_interior = $info_employee->t_no_interior;
        $no_exterior = $info_employee->t_no_exterior;
        $references = $info_employee->t_references;
        $street = $info_employee->t_street;
        $colony = $info_employee->t_colony;
        $puesto = $info_employee->fk_position === null ? "Ninguno" : ($DataBase->read_single_record_position($info_employee->fk_position)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_position($info_employee->fk_position)->t_name);
        $cargo = $info_employee->fk_charge === null ? "Ninguno" : ($DataBase->read_single_record_charges($info_employee->fk_charge)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_charges($info_employee->fk_charge)->t_name);
        $id_area = $info_employee->fk_position == null ? null : ($DataBase->read_single_record_area_position($info_employee->fk_position) ? $DataBase->read_single_record_area_position($info_employee->fk_position)->fk_area : null);
        $area = $id_area == null ? "Ninguna" : $DataBase->read_single_record_area($id_area)->t_name;
        $path_p = $DataBase->read_single_record_files($info_employee->fk_img)->t_path;
        $count = $DataBase->count_data_training($id) ? $DataBase->count_data_training($id)->count_data : 0; 
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Reporte de Empleado | No. Control $id",0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Informacion General",1,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $rows_static_info_general = array('Nombre Completo', 'Email','RFC','NSS','Telefono','Fecha de Nacimiento');
        $rows_dynamic_info_general = array("$fullname","$email","$rfc","$nss","$phone_number","$birthday");
        for ($a = 0; $a <= count($rows_static_info_general)-1; $a++) {
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(70,$row_height,"$rows_static_info_general[$a]",1);
            $this->Cell(130,$row_height,"$rows_dynamic_info_general[$a]",1);
            $y_actual += ($row_height_table-$y_initial);
        }
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Informacion de Domicilio",1,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $rows_static_info_residence = array('Colonia', 'Calle','No. Exterior','No. Interior','Referencias');
        $rows_dynamic_info_residence = array("$colony","$street","$no_exterior","$no_interior","$references");
        for ($a = 0; $a <= count($rows_static_info_residence)-1; $a++) {
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(70,$row_height,"$rows_static_info_residence[$a]",1);
            $this->Cell(130,$row_height,"$rows_dynamic_info_residence[$a]",1);
            $y_actual += ($row_height_table-$y_initial);
        }
        $this->SetY($y_actual);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Informacion de Trabajo",1,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $rows_static_info_residence = array('Puesto', 'Cargo','Area','No. Capacitaciones');
        $rows_dynamic_info_residence = array("$puesto","$cargo","$area","$count");
        for ($a = 0; $a <= count($rows_static_info_residence)-1; $a++) {
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(70,$row_height,"$rows_static_info_residence[$a]",1);
            $this->Cell(130,$row_height,"$rows_dynamic_info_residence[$a]",1);
            $y_actual += ($row_height_table-$y_initial);
        }
        $this->AddPage();
        $y_actual = $row_height_table;
        $this->SetY($y_initial);
        $this->SetX($x_initial);
        $this->Cell(200,$row_height,"Listado de Capacitaciones",0,0,'C',1);
        $y_actual += ($row_height_table-$y_initial);
        $l_training = $DataBase->read_data_table_employees_trainings($id);
        
        $num_cap = 0;
        $separator = 0;
        while($row = mysqli_fetch_object($l_training)){
            $id_training = $row->fk_training;
            $infotrain = $DataBase->read_single_record_training($id_training);
            $nombre = $infotrain->t_name; 
            $periodo = $infotrain->d_dates;
            $descripcion = $infotrain->t_description;
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $num_cap += 1;
            $this->Cell(200,$row_height,"Capacitacion No. $num_cap",1,0,'C',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(60,$row_height,"Nombre",1,0,'C',1);
            $this->Cell(140,$row_height,"$nombre",1,0,'L',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(60,$row_height,"Periodo de Realizacion",1,0,'C',1);
            $this->Cell(140,$row_height,$periodo,1,0,'L',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(60,$row_height,"No. de evidencias",1,0,'C',1);
            $this->Cell(140,$row_height,$fullname,1,0,'L',1);
            $y_actual += ($row_height_table-$y_initial);
            $this->SetY($y_actual);
            $this->SetX($x_initial);
            $this->Cell(200,$row_height,"Descripcion",1,"L",'C');
            $this->MultiCell(200,$row_height,"$descripcion",1,0,0);
            $y_actual += ($row_height_table-$y_initial)+10;
            
            //Go to next row
            $y_actual += ($row_height_table-$y_initial)+80;
            $separator += 1;
            if($separator == 2){
                $this->addPage();
                $y_actual = $row_height_table;
            }
        }
        $this->AliasNbPages();
        //Send file
        $this->Output();
    }
}
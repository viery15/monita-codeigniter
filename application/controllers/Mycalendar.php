<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/11/2019
 * Time: 3:19 PM
 */
?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mycalendar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }

        $this->load->model("category_model");
        $this->load->model("task_model");
    }

    public function index()
    {
        $data["task"] = $this->task_model->getTaskCalender();
        $data["category"] = $this->category_model->getAll();

        $this->load->view("mycalendar",$data);
    }

    public function search()
    {
        $post = $this->input->post();
        $data["task"] = $this->task_model->searchCalendar();

        $data['year'] = $post['year'];

        $this->load->view("mycalendar_content",$data);
    }

    public function info($id){
        $data['task'] = $this->task_model->getById($id);
        $this->load->view("modal-info",$data);
    }

    public function excel(){
        $post = $this->input->post();

        $task = $this->task_model->searchCalendar();

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $excel = new PHPExcel();

        $excel->getProperties()->setCreator("MONITA")
            ->setLastModifiedBy("MONITA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Task Report .")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Task Report");

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $excel->getActiveSheet()->freezePane('F2');
        $title = 'judul';

        $excel->getActiveSheet()->setTitle('calendar '.$this->session->nik);
        $excel->setActiveSheetIndex(0);

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );


         $color_pending = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF00')
            )
         );

        $color_progress = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '35f235')
            )
        );

        $color_done = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '0000FF')
            )
        );

        $color_rejected = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '000000')
            )
        );

        $color_canceled = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'D62222')
            )
        );

        $color_weekend = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FF0000')
            )
        );

        // $excel->setActiveSheetIndex(0)->setCellValue('D3', 'Task of '.$this->session->nik.' (per '. date('d M Y', strtotime($date_from)).' - '. date('d M Y', strtotime($date_to)).')');

        $excel->setActiveSheetIndex(0)
            ->setCellValue('B5', 'No')->mergeCells('B5:B6')
            ->setCellValue('C5', 'Category')->mergeCells('C5:C6')
            ->setCellValue('D5', 'Title')->mergeCells('D5:D6')
            ->setCellValue('E5', 'Description')->mergeCells('E5:E6')
            ->setCellValue('F5', 'Start Date')->mergeCells('F5:F6')
            ->setCellValue('G5', 'End Date')->mergeCells('G5:G6')
            ->setCellValue('I5', $post["year"])->mergeCells('I5:T5')
            ->setCellValue('I6', 'JAN')
            ->setCellValue('J6', 'FEB')
            ->setCellValue('K6', 'MAR')
            ->setCellValue('L6', 'APR')
            ->setCellValue('M6', 'MEI')
            ->setCellValue('N6', 'JUN')
            ->setCellValue('O6', 'JUL')
            ->setCellValue('P6', 'AGS')
            ->setCellValue('Q6', 'SEP')
            ->setCellValue('R6', 'OKT')
            ->setCellValue('S6', 'NOV')
            ->setCellValue('T6', 'DEC')
            ->setCellValue('H5', 'Status')->mergeCells('H5:H6');

        // SET STYLE FOR HEAD TABLE
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(5); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom G
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom H

        $excel->getActiveSheet()->getStyle('B5:B6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C5:C6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D5:D6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E5:E6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F5:F6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G5:G6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5:H6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I5:T5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I6:T6')->applyFromArray($style_col);


        //LOOPING YEAR MONTH DATE
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; //baris pertama
        foreach($task as $data){ // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->category);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->remark);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, str_replace('\n', ' &nbsp;', htmlspecialchars($data->description)));
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, date('d M Y', strtotime($data->date_from)));
            $excel->setActiveSheetIndex(0)->setCellValue('g'.$numrow, date('d M Y', strtotime($data->date_to)));
            $excel->setActiveSheetIndex(0)->setCellValue('h'.$numrow, $data->status);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $col_from = 'I';
        $row_from = 7;
        foreach($task as $data){
          if ($data->status == 'pending') {
            $color = $color_pending;
          }
          if ($data->status == 'done') {
            $color = $color_done;
          }
          if ($data->status == 'progress') {
            $color = $color_progress;
          }
          if ($data->status == 'canceled') {
            $color = $color_canceled;
          }
          if ($data->status == 'rejected') {
            $color = $color_rejected;
          }


          for ($i = 1, $j = $col_from; $i <= 12; $i++, $j++) {
            $month_from = date('n', strtotime($data->date_from));
            $month_to = date('n', strtotime($data->date_to));

            if ($i >= $month_from && $i <= $month_to) {
              $excel->getActiveSheet()->getStyle($j . $row_from)->applyFromArray($color);
            }

              $excel->getActiveSheet()->getStyle($j.$row_from)->applyFromArray($style_col);

          }
          $row_from++;
        }

        //perulangan data pada table utama


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="mycalendar.xls"');
        header('Cache-Control: max-age=0');
        ob_end_clean();

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
    }


}

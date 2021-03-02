<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Font, Border, Alignment};
use yii\helpers\StringHelper;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->mergeCells('A1:N1');
$sheet->setCellValue('A1', (Yii::$app->language == 'kk') ? $anketa->name_kaz : $anketa->name_rus);

$sheet->mergeCells('O1:S1');
$sheet->setCellValue('O1', Yii::t('common', 'Жауап бергендер саны: ').count($results));

foreach ($languages as $k => $language) {
	if ($k !== 0) $languagesString .= ', ';
	if ( $language == 'kk' ) {
		$languagesString .= Yii::t('common', 'қазақ');
	} elseif ( $language == 'ru' ) {
		$languagesString .= Yii::t('common', 'орыс');
	}
}
$sheet->mergeCells('O2:S5');
$sheet->setCellValue('O2', Yii::t('common', 'Сауалнамалар өткізілген тіл: ').$languagesString);

$row = 2;

if ( count($headerResults) > 0 ) {

	$sheet->mergeCells('A'.$row.':N'.$row);
	if ( $headerResults[0]->question->type == 'custom' ) {
		$filterHeader = (Yii::$app->language == 'kk') ? '«'.$headerResults[0]->question->name_kaz.'» өрісінің келесі мәндері бойынша нәтижелер:' : 'Результаты выборки по следющим значениям поля «'.$headerResults[0]->question->name_rus.'»:';
	} else {
		$filterHeader = (Yii::$app->language == 'kk') ? '«'.$headerResults[0]->question->typeName.'» өрісінің келесі мәндері бойынша нәтижелер:' : 'Результаты выборки по следющим значениям поля «'.$headerResults[0]->question->typeName.'»:';
	}
	$sheet->setCellValue('A'.$row, $filterHeader);
	$sheet->getRowDimension($row)->setRowHeight(40);
	$sheet->getStyle('A'.$row)->getFont()->setSize(18);
	$row++;
	/* Вопросы шапки т.е. параметры по которым делалась выборка */
	$prevFilterAnswer = null;
	foreach ($headerResults as $headerResult) {

		if ( $headerResult->answer_id !== null ) {
			if ( $headerResult->question->type == 'teacher' ) {
				$filterAnswer = $headerResult->name->name;
			} else {
				$filterAnswer = (Yii::$app->language == 'kk') ? $headerResult->name->name_kaz : $headerResult->name->name_rus;
			}
		} else {
			$filterAnswer = $headerResult->answer_custom;		
		}
		if ($filterAnswer == $prevFilterAnswer) continue;
		$prevFilterAnswer = $filterAnswer;
		$sheet->mergeCells('B'.$row.':N'.$row);
		$sheet->setCellValue('B'.$row, $filterAnswer);
		$sheet->getRowDimension($row)->setRowHeight(20);
		$row++;

	}

	$sheet->mergeCells('A'.$row.':N'.$row);
	$sheet->setCellValue('A'.$row, Yii::t('common', 'Респонденттер туралы мәліметтер'));
	$sheet->getRowDimension($row)->setRowHeight(40);
	$sheet->getStyle('A'.$row)->getFont()->setSize(18);
	$row++;
	foreach ($results as $k => $result) {
		$sheet->setCellValue('A'.$row, ($k+1) );
		foreach ($result->headerResults as $headerResult) {
			$sheet->mergeCells('B'.$row.':D'.$row);
			if ( $headerResult->question->type == 'custom' ) {
				$sheet->setCellValue('B'.$row, (Yii::$app->language == 'kk') ? $headerResult->question->name_kaz : $headerResult->question->name_rus);
			} else {
				$sheet->setCellValue('B'.$row, $headerResult->question->typeName);
			}
			$sheet->mergeCells('E'.$row.':N'.$row);
			if ( $headerResult->answer_id !== null ) {
				if ( $headerResult->question->type == 'teacher' ) {
					$sheet->setCellValue('E'.$row, StringHelper::mb_ucfirst($headerResult->name->name));
				} else {
					$sheet->setCellValue('E'.$row, (Yii::$app->language == 'kk') ? StringHelper::mb_ucfirst($headerResult->name->name_kaz) : StringHelper::mb_ucfirst($headerResult->name->name_rus));
				}
			} else {
				$sheet->setCellValue('E'.$row, $headerResult->answer_custom);
			}
			$row++;
		}
	}
}

$sheet->mergeCells('A'.$row.':N'.$row);
$sheet->getRowDimension($row)->setRowHeight(50);
$row++;
/* Результаты ответов на вопросы ( с указанием доли ответивших по вариантам ответов ) */
$k = 0;
foreach ($countedResults as $countedResult) {
	$k++;
	if ( count($countedResults) > 1 ) {
		$sheet->mergeCells('A'.$row.':N'.$row);
		if ( $countedResult['q_category'] === null ) {
			$categoryName = (Yii::$app->language == 'kk') ? $k.') Жалпы сұрақтар' : $k.') Общие вопросы';
		} else {
			$categoryName = (Yii::$app->language == 'kk') ? $k.') '.$countedResult['q_category']->name_kaz : $k.') '.$countedResult['q_category']->name_rus;
		}
		$sheet->setCellValue('A'.$row, $categoryName);
		$sheet->getStyle('A'.$row)->getFont()->setSize(16)->setBold(true);
		$sheet->getRowDimension($row)->setRowHeight(60);
		$row++;
	}
	$j = 0;
	foreach ($countedResult['questions'] as $question) {
		$j++;
		$sheet->mergeCells('A'.$row.':M'.$row);
		$qPrefix = ( count($countedResults) > 1 ) ? $k.'.'.$j.') ' : $j.') ';
		$sheet->setCellValue('A'.$row, (Yii::$app->language == 'kk') ? $qPrefix.$question['question']->name_kaz : $qPrefix.$question['question']->name_rus );
		$sheet->getRowDimension($row)->setRowHeight(20);
		$sheet->getStyle('A'.$row)->getFont()->setSize(14);

		$row++;

		foreach ($question['options'] as $option) {
			if ( $option['option']['type'] == 'percentage' ) {
				$resultValue = round(array_sum($option['custom_answer'])/count($option['custom_answer']), 1).'% ('.$option['count'].')';
				$questionName = (Yii::$app->language == 'kk') ? $option['option']['name_kaz'].' (орташа)' : $option['option']['name_rus'].' (среднее)';
			} else {
				$resultValue = round($option['count']/$question['total']*100, 1).'% ('.$option['count'].')';
				$questionName = (Yii::$app->language == 'kk') ? $option['option']['name_kaz'].' ' : $option['option']['name_rus'].' ';
			}

			$sheet->mergeCells('B'.$row.':L'.$row);
			$sheet->setCellValue('B'.$row, $questionName);
			$sheet->setCellValue('M'.$row, $resultValue );
			$sheet->getRowDimension($row)->setRowHeight(15);
			$sheet->getStyle('B'.$row)->getFont()->setSize(12);
			$row++;
			if ( !empty($option['custom_answer']) ) {
				$sheet->mergeCells('C'.$row.':L'.$row);
				$sheet->setCellValue('C'.$row, Yii::t('common', 'Респонденттердің өз жауаптары: '));
				$sheet->getRowDimension($row)->setRowHeight(15);
				$row++;
				foreach ($option['custom_answer'] as $o => $custom_answer) {
					$sheet->mergeCells('C'.$row.':L'.$row);
					$sheet->setCellValue('C'.$row, ($o+1).') '.$custom_answer);
					$sheet->getRowDimension($row)->setRowHeight(15);
					$row++;
				}
			}
		}
	}
}




/* styles */
$sheet->getColumnDimension('A')->setWidth(4);
$sheet->getColumnDimension('B')->setWidth(10);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);

$sheet->getRowDimension(1)->setRowHeight(100);


$sheet->getStyle('A1')->applyFromArray([
	'font' => [
		'size' => 24,
		'bold' => true,
		'italic' => false,
		//'underline' => Font::UNDERLINE_DOUBLE,
		'strikethrough' => false,
		//'color' => [
		//    'rgb' => '808080'
		//  ]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ]
]);
$sheet->getStyle('O1:S2')->applyFromArray([
	'font' => [
		'size' => 14,
		'italic' => false,
		'strikethrough' => false,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ]
]);
$sheet->getStyle('A2:M'.$row)->applyFromArray([
    'alignment' => [
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ]
]);


/* Export to xlsx */
$filename = (Yii::$app->language == 'kk') ? '"'.$anketa->name_kaz.time().'.xls"' : '"'.$anketa->name_rus.time().'.xls"';
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
$writer->save("php://output");
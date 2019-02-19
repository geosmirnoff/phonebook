<?php
	header('Content-Type: text/html; charset=UTF-8');
	require_once('connect.php');
	require_once('tcpdf/tcpdf.php');

	$workshop = $_POST['table']; //номер подразделения
	$query = "SELECT phone_num, workshop_num, fio, post, chief
				FROM list
					WHERE workshop_num = '".$workshop."'";
	$name = "SELECT name FROM tree WHERE workshop='".$workshop."'";
	$resname = mysqli_query($link, $name);
	$rowname = mysqli_fetch_assoc($resname);
	$res = mysqli_query($link, $query);
	if (mysqli_num_rows($res) > 0)
	{
		$row = mysqli_fetch_assoc($res);
		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->AddPage();
		
		$head = '<img src="pdf-header.jpg" />';
		$head .= '<h1 style="text-align: center">Телефонный справочник<br>абонентов АТС</h1>';
		$head .= '<table cellspacing="0" cellpadding="15">
			<thead>
				<tr>
					<th colspan="2"><strong>Телефоны экстренной помощи</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>При пожаре</td>
					<td>33-50<br>34-50</td>
				</tr>
				<tr>
					<td>Начальник отдела вахтенной службы </td>
					<td>23-02</td>
				</tr>
				<tr>
					<td>Заместитель начальника </td>
					<td>98-94</td>
				</tr>
				<tr>
					<td>Оперативный дежурный </td>
					<td>23-98</td>
				</tr>
				<tr>
					<td>Медицинская помощь </td>
					<td>98-02</td>
				</tr>
				<tr>
					<th><strong>Общезаводской факс</strong></th>
					<td>784-76-78</td>
				</tr>
				<tr>
					<th><strong>Электронная почта</strong></th>
					<td>info@nordsy.spb.ru</td>
				</tr>
				<tr>
					<th><strong>Справочное</strong></th>
					<td>324-29-01</td>
				</tr>
			</tbody>
		</table>';

		$head .= '<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p style="text-align: center; padding-top: 1000px">Санкт-Петербург<br>2018</p>';
		$pdf->writeHTML($head, true, false, false, false, '');
		$pdf->AddPage();
		$tbl = '<h1>'.$workshop.' - '.$rowname['name'].'</h1><table cellspacing="0" cellpadding="5" border="1">
					<tr>
						<td><strong>ФИО</strong></td>
						<td><strong>Должность</strong></td>
						<td><strong>Номер</strong></td>
					</tr>';
		if ($row['chief'] == 1)
		{
			if (strlen($row['phone_num']) == 9)
			{
				$num = substr($row['phone_num'], 4);
			} else
			{
				$num = $row['phone_num'];
			}
			$phones = explode(",", $num);
			$tbl .= "<tr>
					<td>".$row['fio']."</td>
					<td>".$row['post']."</td><td>";
			foreach ($phones as $phone)
			{
				$tbl .= $phone."&nbsp;<br>";
			}
			$tbl .= "</td></tr>";	
		}
		while ($row = mysqli_fetch_assoc($res))
		{
			if (strlen($row['phone_num']) == 9)
			{
				$num = substr($row['phone_num'], 4);
			} else
			{
				$num = $row['phone_num'];
			}
			if ($row['chief'] != 1)
			{
				$tbl .= "<tr>
						<td>".$row['fio']."</td>
						<td>".$row['post']."</td>
						<td>".$num."</td>
					</tr>";	
			}
		}
		$tbl .= "</table>";
		$pdf->writeHTML($tbl, true, false, false, false, '');
		$pdf->lastPage();
		$pdf->Output('phonelist.pdf', 'I');
	} else
	{
		echo "Ничего не найдено :(";
	}
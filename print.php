<?php
	header('Content-Type: text/html; charset=UTF-8');
	require_once('connect.php');
	require_once('tcpdf/tcpdf.php');

	$query = "SELECT name, workshop FROM tree ORDER BY workshop";
	$res = mysqli_query($link, $query);
	$res2 = mysqli_query($link, $query);
	$res3 = mysqli_query($link, $query);
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

		
	while ($row = mysqli_fetch_assoc($res))
	{
		if ($row['workshop']{0} == "5")
		{
			$list = '<h1 style="text-align: center">'.$row['workshop'].' - '.$row['name'].'</h1>
				<table cellspacing="0" cellpadding="5" border="1">
					<thead>
						<tr>
							<th><strong>ФИО</strong></th>
							<th><strong>Должность</strong></th>
							<th><strong>Телефон</strong></th></tr></thead><tbody>';
			$query_in = "SELECT phone_num, workshop_num, fio, post, chief
					FROM list WHERE workshop_num = '".$row['workshop']."'";
			$res_in = mysqli_query($link, $query_in);
			$row_in = mysqli_fetch_assoc($res_in);
			if ($row_in['chief'] == 1)
			{
				if (strlen($row_in['phone_num']) == 9)
				{
					$num = substr($row_in['phone_num'], 4);
				} else
				{
					$num = $row_in['phone_num'];
				}
				$phones = explode(",", $num);
				$list .= '<tr>
						<td>'.$row_in['fio'].'</td>
						<td>'.$row_in['post'].'</td>
						<td>';
				foreach ($phones as $phone)
				{
					$list .= '<p>'.$phone.'</p>';
				}
				$list .= '</td></tr>';

			}
			while ($row_in = mysqli_fetch_assoc($res_in))
			{
				if ($row_in['chief'] != 1)
				{
					if (strlen($row_in['phone_num']) == 9)
					{
						$num = substr($row_in['phone_num'], 4);
					} else
					{
						$num = $row_in['phone_num'];
					}
					$phones = explode(",", $num);
					$list .= '<tr>
							<td>'.$row_in['fio'].'</td>
							<td>'.$row_in['post'].'</td>
							<td>';
					foreach ($phones as $phone)
					{
						$list .= '<p>'.$phone.'</p>';
					}	
					$list .= '</td></tr>';
				}
			}
			$list .= '</tbody></table>';
			$pdf->writeHTML($list, true, false, false, false, '');
		}
	}
	while ($row2 = mysqli_fetch_assoc($res2))
	{
		if ($row2['workshop']{0} == "4")
		{
			$list = '<h1 style="text-align: center">'.$row2['workshop'].' - '.$row2['name'].'</h1>
				<table cellspacing="0" cellpadding="5" border="1">
					<thead>
						<tr>
							<th><strong>ФИО</strong></th>
							<th><strong>Должность</strong></th>
							<th><strong>Телефон</strong></th></tr></thead><tbody>';
			$query2_in = "SELECT phone_num, workshop_num, fio, post, chief
					FROM list WHERE workshop_num = '".$row2['workshop']."'";
			$res2_in = mysqli_query($link, $query2_in);
			$row2_in = mysqli_fetch_assoc($res2_in);
			if ($row2_in['chief'] == 1)
			{
				if (strlen($row2_in['phone_num']) == 9)
				{
					$num = substr($row2_in['phone_num'], 4);
				} else
				{
					$num = $row2_in['phone_num'];
				}
				$phones = explode(",", $num);
				$list .= '<tr>
						<td>'.$row2_in['fio'].'</td>
						<td>'.$row2_in['post'].'</td>
						<td>';
				foreach ($phones as $phone)
				{
					$list .= '<p>'.$phone.'</p>';
				}
				$list .= '</td></tr>';

			}
			while ($row2_in = mysqli_fetch_assoc($res2_in))
			{
				if ($row2_in['chief'] != 1)
				{
					if (strlen($row2_in['phone_num']) == 9)
					{
						$num = substr($row2_in['phone_num'], 4);
					} else
					{
						$num = $row2_in['phone_num'];
					}
					$phones = explode(",", $num);
					$list .= '<tr>
							<td>'.$row2_in['fio'].'</td>
							<td>'.$row2_in['post'].'</td>
							<td>';
					foreach ($phones as $phone)
					{
						$list .= '<p>'.$phone.'</p>';
					}	
					$list .= '</td></tr>';
				}
			}
			$list .= '</tbody></table>';
			$pdf->writeHTML($list, true, false, false, false, '');
		}
	}
	while ($row3 = mysqli_fetch_assoc($res3))
	{
		if ($row3['workshop']{0} == "0")
		{
			$list = '<h1 style="text-align: center">'.$row3['workshop'].' - '.$row3['name'].'</h1>
				<table cellspacing="0" cellpadding="5" border="1">
					<thead>
						<tr>
							<th><strong>ФИО</strong></th>
							<th><strong>Должность</strong></th>
							<th><strong>Телефон</strong></th></tr></thead><tbody>';
			$query3_in = "SELECT phone_num, workshop_num, fio, post, chief
					FROM list WHERE workshop_num = '".$row3['workshop']."'";
			$res3_in = mysqli_query($link, $query3_in);
			$row3_in = mysqli_fetch_assoc($res3_in);
			if ($row3_in['chief'] == 1)
			{
				if (strlen($row3_in['phone_num']) == 9)
				{
					$num = substr($row3_in['phone_num'], 4);
				} else
				{
					$num = $row3_in['phone_num'];
				}
				$phones = explode(",", $num);
				$list .= '<tr>
						<td>'.$row3_in['fio'].'</td>
						<td>'.$row3_in['post'].'</td>
						<td>';
				foreach ($phones as $phone)
				{
					$list .= '<p>'.$phone.'</p>';
				}
				$list .= '</td></tr>';

			}
			while ($row3_in = mysqli_fetch_assoc($res3_in))
			{
				if ($row3_in['chief'] != 1)
				{
					if (strlen($row3_in['phone_num']) == 9)
					{
						$num = substr($row3_in['phone_num'], 4);
					} else
					{
						$num = $row3_in['phone_num'];
					}
					$phones = explode(",", $num);
					$list .= '<tr>
							<td>'.$row3_in['fio'].'</td>
							<td>'.$row3_in['post'].'</td>
							<td>';
					foreach ($phones as $phone)
					{
						$list .= '<p>'.$phone.'</p>';
					}	
					$list .= '</td></tr>';
				}
			}
			$list .= '</tbody></table>';
			$pdf->writeHTML($list, true, false, false, false, '');
		}
	}
	/*$pdf->writeHTML($list, true, false, false, false, '');*/
	$pdf->lastPage();
	$pdf->Output('phonelist.pdf', 'I');
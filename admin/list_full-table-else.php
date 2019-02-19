<?php else: ?>
			<?php if (mysqli_num_rows($res) > 0) : ?>
				<table class="u-half-width">
					<thead>
						<tr>
							<th>ФИО&nbsp;</th>
							<th>&nbsp;Отдел&nbsp;</th>
							<th>Должность</th>
							<th colspan='3'>&nbsp;Телефон</th>
						</tr>
					</thead>
					<tbody>
				<?php while ($row = mysqli_fetch_assoc($res)) : ?>
						<tr>
							<td><?php echo $row['fio']; ?>&nbsp;</td>
							<td>&nbsp;<?php echo $row['workshop_num']; ?>&nbsp;</td>
							<td>
								<?php 
									$postlen = explode(" ", $row['post']);
									foreach ($postlen as $key => $post) {
										echo $post." ";
										if ($key % 4 == 0 && $key != 0)
										{
											echo "<br>";
										}
									}
									
								?>
							</td>
							<?php $phones = explode(",", $row['phone_num']); ?>
							<td>
								<?php
									foreach ($phones as $phone)
									{
										echo $phone."&nbsp;<br>";
									}
								?>
							</td>
							<td>&nbsp;<a href="edit.php?id=<?=$row['id']; ?>"><img src="img/edit.png"></a>&nbsp;</td>
							<td>&nbsp;<a href="delete.php?id=<?=$row['id']; ?>"><img src="img/delete.png"></a>&nbsp;</td>
						</tr>
				<?php endwhile; ?>
					</tbody>
				</table>
			<?php endif; ?>
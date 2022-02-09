<?php
  $host ="127.0.0.1"; //host server
  $user ="root"; //user login phpMyAdmin
  $pass =""; //pass login phpMyAdmin
  $db ="gsw"; //nama database
  $koneksi = mysqli_connect($host, $user, $pass, $db) or die ("Koneksi gagal");
?>

				<td>
					<ul class="list-unstyled">
						<li th:each="pricingschema : ${item.pricingSchemas}">
							<a th:text="${pricingschema.description}" th:href="@{/item/3/{itemId}/pricingschema/{schemaId}(itemId=${item.id}, schemaId=${pricingschema.id}, typedesc=${itemType.path}, search=${persistSearch}, name=${key1})}"></a>
						</li>
					</ul>
				</td>
				
				
perubahan yang dilakukan yaitu

>adanya pop up pada form insert data untuk meyakinkan admin bahwa data yang diinput sudah sesuai
>tabel data pada index kolom update data diubah menjadi 'see details'
>update data tidak bisa dilakukan dikarenakan sesuai permintaan jika ada kesalahan update data tidak dapat dilakukan
>pemilihan tanggal expired date sudah tersedia

<ul class="list-unstyled">
						<li th:each="pricingschema : ${item.pricingSchemas}">
							<a th:text="${pricingschema.description}" th:href="@{/item/3/{itemId}/pricingschema/{schemaId}(itemId=${item.id}, schemaId=${pricingschema.id}, typedesc=${itemType.path}, search=${persistSearch}, name=${key1})}"></a>
						</li>
					</ul>
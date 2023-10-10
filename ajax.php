<?php
	require_once 'config/config.php';
	$process =  $input->post('process');
	switch( $process ){
		case  "DOCTORS_BY_DEPT" :
		$department_id = (int)$input->post('department_id');
		$res =  $db->get('doctors',array('department_id' => $department_id));
		header('Content-Type: application/json');
		$return = array(
		  'status'=>'1',
		  'doctors' =>$res,
		);
		echo json_encode($return); 
		break;

		case  "GET_MEDICINE_INFO" :
		$medicine_id = (int)$input->post('medicineid');
		$dosage = $input->post('dosage');
		$duration = $input->post('duration');
		$sql = "SELECT med.*,mc.`name` AS category_name  FROM `medicines` med
		LEFT JOIN `medicine_categories` mc ON med.`category_id` = mc.`id`
		WHERE med.`id`='".$medicine_id."'";
		$medicine = $db->execute_get_row($sql);
		header('Content-Type: application/json');
		$status =  0 ;
		$med_label = "";
		if( $medicine != null ){
			$status = 1 ;
			$med_label =   $medicine->name." - ". $medicine->category_name; 
		}
		$return = array(
		  'status'=> $status,
		  'med_label' =>$med_label,
		  'dosage' =>$dosage, 
		  'duration' =>$duration, 
		  'medicine_id' =>$medicine_id, 
		); 
		echo json_encode($return); 
		break;

		case  "DELETE_PRESCRIBED_MEDICINE" :
		$id = (int)$input->post('id');
		$res =  $db->delete('prescriptions',array('id' => $id));
		header('Content-Type: application/json');
		$return = array(
		  'status'=>'1',
		  'id' =>$id,
		);
		echo json_encode($return); 
		break;

		case  "ADD_MEDICIN_BILL_ROW" :
		$medicine_id = (int)$input->post('medicineid');
		$quantity = (float)$input->post('quantity');
		$stock = $db->get_colum_value('medicines','stock',array('id' => $medicine_id ));
		$available = '1';
		if ( (float)$stock < (float)$quantity){
			$available = '0';
		}
		$sql = "SELECT med.*,mc.`name` AS category_name  FROM `medicines` med
		LEFT JOIN `medicine_categories` mc ON med.`category_id` = mc.`id`
		WHERE med.`id`='".$medicine_id."'";
		$medicine = $db->execute_get_row($sql);
		header('Content-Type: application/json');
		$status =  0 ;
		$med_label = "";
		$rate = "";
		if( $medicine != null ){
			$status = 1 ;
			$med_label =   $medicine->name." - ". $medicine->category_name; 
			$rate = $medicine->rate;
		}
		$return = array(
		  'status'=> $status,
		  'med_label' => $med_label,
		  'quantity' => $quantity, 
		  'medicine_id' =>$medicine_id, 
		  'rate' => number_format($rate,2) , 
		  'total' => number_format( $rate*$quantity,2 ) , 
		  'available' =>$available,
		  'stock' =>$stock,
		); 
		echo json_encode($return); 
		break;

		case  "ADD_STOCK_ITME_ROW" :
		$medicine_id = (int)$input->post('medicineid');
		$quantity = (float)$input->post('quantity');

		
		$sql = "SELECT med.*,mc.`name` AS category_name  FROM `medicines` med
		LEFT JOIN `medicine_categories` mc ON med.`category_id` = mc.`id`
		WHERE med.`id`='".$medicine_id."'";
		$medicine = $db->execute_get_row($sql);
		header('Content-Type: application/json');
		$status =  0 ;
		$med_label = "";
		$rate = "";
		if( $medicine != null ){
			$status = 1 ;
			$med_label =   $medicine->name." - ". $medicine->category_name; 
		}
		$return = array(
		  'status'=> $status,
		  'med_label' => $med_label,
		  'quantity' => $quantity, 
		  'medicine_id' =>$medicine_id,
		); 
		echo json_encode($return); 
		break;
		case  "DELETE_BILL_MEDICINE" :
		$id = (int)$input->post('id');
		$sale_item = $db->get_row('medicine_sale_items',array('id' => $id ));
		$status = 0;
		if ( $sale_item != null ){
			$medicine_id =  $sale_item->medicine_id;
			$quantity =  $sale_item->quantity;
			$res =  $db->delete('medicine_sale_items',array('id' => $id));
			if ( $res ){
				$sql = "UPDATE `medicines` SET `stock`= `stock`+".$quantity."  WHERE id='".(int)$medicine_id."'";
	        	$db->execute($sql); 
	        	$status = 1;
			}
		}
		header('Content-Type: application/json');
		$return = array(
		  'status'=>$status,
		  'id' =>$id,
		);
		echo json_encode($return); 
		break;


		case  "DELETE_STOCK_ITEM" :
		$id = (int)$input->post('id');
		$stock_item = $db->get_row('stock_items',array('id' => $id ));
		$status = 0;
		if ( $stock_item != null ){
			$medicine_id =  $stock_item->medicine_id;
			$quantity =  $stock_item->quantity;
			$res =  $db->delete('stock_items',array('id' => $id));
			if ( $res ){
				$sql = "UPDATE `medicines` SET `stock`= `stock`-".$quantity."  WHERE id='".(int)$medicine_id."'";
	        	$db->execute($sql); 
	        	$status = 1;
			}
		}
		
		header('Content-Type: application/json');
		$return = array(
		  'status'=> $status ,
		  'id' => $id,
		);
		echo json_encode($return); 
		break;

		


		
	}
?>

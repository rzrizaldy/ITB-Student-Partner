<?php
/* Create database */

	//Database connection
	include ('config.php');
	
	//Delete table query
	$review ='DROP TABLE IF EXISTS Review';
	mysqli_query($conn, $review);
	
	$sql ='DROP TABLE IF EXISTS MataKuliah';
	mysqli_query($conn, $sql);
	
	//Create table MataKuliah
	$sql = 'CREATE TABLE MataKuliah (
			m_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			kodeMataKuliah VARCHAR(6) NOT NULL,
			namaMataKuliah VARCHAR(60) NOT NULL,
			jumlahSks INT(2) NOT NULL) ';
	//Check query
	if (mysqli_query($conn, $sql)) 
	{
	    echo "Table MataKuliah created successfully";
	} else {
	    echo "Error creating table: " . mysqli_error($conn);
	}
	
	//Create table Review
	$review = 'CREATE TABLE Review (
			r_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			m_id INT(4) UNSIGNED NOT NULL,
			review VARCHAR(3000) NOT NULL,
			vote INT(100),
			FOREIGN KEY (m_id) REFERENCES MataKuliah(m_id))';
	//Check query
	if (mysqli_query($conn, $review)) 
	{
	    echo "Table Review created successfully";
	} else {
	    echo "Error creating table: " . mysqli_error($conn);
	}
	
	//Close connection
	mysqli_close($conn);

?>
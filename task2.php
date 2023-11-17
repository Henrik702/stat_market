<?php
include 'connect.php';

try {
    // 1. Adding three columns
    $sql1 = "ALTER TABLE users
             ADD COLUMN new_column1 INT,
             ADD COLUMN new_column2 VARCHAR(50),
             ADD COLUMN new_column3 DATE";
    $con->exec($sql1);

    // 2. Changing data type
    $sql2 = "ALTER TABLE users
             MODIFY COLUMN name VARCHAR(100)";
    $con->exec($sql2);

    // 3. Adding two indexes
    $sql3 = "CREATE INDEX idx_group_id ON users (group_id)";
    $sql4 = "CREATE INDEX idx_posts_qty ON users (posts_qty)";
    $con->exec($sql3);
    $con->exec($sql4);

    echo "Queries executed successfully";
} catch (PDOException $e) {
    echo "Error executing queries: " . $e->getMessage();
}




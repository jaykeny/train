<?php

class Train {

  const DEFAULT_CSV = 'upload/trains_6.csv';

  public $file;
  public $csv; // CSV Data
  public $rows = []; // CSV Array
  private static $instance = null;

  public function __construct($file)
  {
    $this->file = $file;
    $this->csv = $this->csv_as_array($file);
  }
  
  /**
   * Display the table
   *
   * @return void
   */
  public function display_table() {
    foreach($this->rows as $row_id => $row_data) {
      if (!empty($row_data['TRAIN_LINE']) && !empty($row_data['ROUTE_NAME']) && !empty($row_data['RUN_NUMBER']) && !empty($row_data['OPERATOR_ID'])) {
        ?>
          <tr>
            <th scope="row"><?php echo !empty($row_data['TRAIN_LINE']) ? $row_data['TRAIN_LINE'] : ''; ?></th>
            <td><?php echo !empty($row_data['ROUTE_NAME']) ? $row_data['ROUTE_NAME'] : ''; ?></td>
            <td><?php echo !empty($row_data['RUN_NUMBER']) ? $row_data['RUN_NUMBER'] : ''; ?></td>
            <td><?php echo !empty($row_data['OPERATOR_ID']) ? $row_data['OPERATOR_ID'] : ''; ?></td>
          </tr>
        <?php
      }
    }
  }
  
  /**
   * Convert CSV data into array
   *
   * @param  mixed $csv File to be converted
   * @return void
   */
  public function csv_as_array($csv = '') {
    $formatted = [];
    $csv = empty($csv) ? self::DEFAULT_CSV : $csv;

    $file = fopen($csv, 'r');

    while (!feof($file)) {
      $rows[] = fgetcsv($file, 0, ',');
    }

    fclose($file);

    unset($rows[0]); // Remove headers

    $rows = array_values($rows); // Reindex

    // Format the multidimensional array to have keys
    foreach($rows as $row) {
      $train_line = !empty($row[0]) ? $row[0] : '';
      $route_name = !empty($row[1]) ? $row[1] : '';
      $run_number = !empty($row[2]) ? $row[2] : '';
      $operator_id = !empty($row[3]) ? $row[3] : '';

      $formatted[] = array(
        'TRAIN_LINE' => $train_line,
        'ROUTE_NAME' => $route_name,
        'RUN_NUMBER' => $run_number,
        'OPERATOR_ID' => $operator_id
      );
    }

    $this->dedup($formatted);
  }
  
  /**
   * Check array for duplicate data and remove it
   *
   * @param  mixed $rows The array data
   * @return void
   */
  private function dedup($rows) {

    $serialized = array_map('serialize', $rows);
    $unique = array_unique($serialized);

    $rows = array_intersect_key($rows, $unique);

    $this->sort($rows);
  }

  /**
   * Sort array alphabetically by RUN_NUMBER
   *
   * @param  mixed $rows The array data
   * @return void
   */
  private function sort($rows)
  {
    $col = array_column($rows, 'RUN_NUMBER');

    array_multisort($col, SORT_ASC, $rows);
    
    $this->rows = $rows;
  }

}


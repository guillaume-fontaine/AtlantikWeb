  <table class="table-responsive">
   <thead>
    <tr>
      <th rowspan="2">Catégorie</th>
      <th rowspan="2">Type</th>
      <?php      
      echo'
      <th colspan="'.$nombrePeriode.'">Période</th>
      ';
      ?>
    </tr>
    <tr>
      <?php
      foreach ($listPeriode as $periode){
        echo '
        <th>'.$periode->datedebut.'</br>'.$periode->datefin.'</th>';
      }
      ?>
    </tr>
   </thead>
   <tbody>
<?php
  $tableCreate = array();
  $count = 0;
  $countTR = 0;
    foreach ($listCategorie as $categorie){
      $rowspanTable = 0;
      $count += 1;
      $lineTable = '';
      foreach($listType as $type){
        if($type->lettrecategorie == $categorie->lettrecategorie){
          $lineTable .= '<td class="td-first-child">'.$type->lettrecategorie.$type->notype.' - '.$type->libelle.'</td>';
          foreach($listTarifParLiaison as $tarif){
            if($type->lettrecategorie == $tarif->lettrecategorie && $type->notype == $tarif->notype){
              $lineTable .= '<td>'.$tarif->tarif.'</td>';
            }
          }
          $tableCreate[$count] = $lineTable.'</tr>
';
          $lineTable = '<tr>';
          $count += 1;
          $rowspanTable += 1;
        }
      }
      $tableCreate[$countTR] = '<tr><td rowspan="'.$rowspanTable.'">'.$categorie->lettrecategorie.'</br>'.$categorie->libelle.'</td>';
      $countTR = $count;
    }
    ksort($tableCreate);
    foreach ($tableCreate as $table){
      echo $table;
    }
?>
</tbody>
 </table>
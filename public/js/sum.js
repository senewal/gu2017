function myFunction() {
      // инициализация сумм (строки и общей)
  var rowSumm = 0;
  var totalSum = 0;
  var tds = 0;
  var tds2 = 0;
    
  
  // берем таблицу1
  var table = document.getElementById("mytab");
  var trs = table.getElementsByTagName("tr");
    
    // берем таблицу2
  var table2 = document.getElementById("totaltab");
  var trs2 = table2.getElementsByTagName("tr");
    
  // итерирование по строкам    
  for (var i = 1, row; row = table.rows[i]; i++) {
    // обнуляем сумму по строке
    rowSumm = 1;
    // итерирование по столбцам      
     
       for (var j = 3, col;j < 5; j++) {
           col = row.cells[j]
      rowSumm *= parseFloat(col.firstChild.nodeValue); // ParseFloat(col.innerHTML);    
        tds = trs[i].getElementsByTagName("td");
         
    } 
                      
      totalSum += rowSumm;
      tds[4].innerHTML = rowSumm;
      
      
     
   // alert('сумма в строке: ' + rowSumm);
  }
 tds2 = trs2[0].getElementsByTagName("th");
   
  //alert('итоговая сумма: ' + totalSum);
    
    tds2[1].innerHTML = totalSum + " рублей"; 
}
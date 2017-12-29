// Глобальная переменная для расчета суммы экономии
var totalSum;

// Расчет суммы строк и итого
function myFunction() {
      // инициализация сумм (строки и общей)
  var rowSumm = 0;
  totalSum = 0;
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

// Расчет в строке Сэкономлено

function spentFunction() {
   var spent = document.getElementById('spent').value; 
    //alert(spent);
   var planned = totalSum;
    //alert(planned);
    var saved = planned - spent;
    //alert(saved);
    if (saved > 0) 
        {
            save.innerHTML = saved + " рублей";
        }
        
    else {save.innerHTML = " Перерасход!";}
    
}
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right"> 
                <?php  
                if($jum_halaman==0){ 
                   //tidak ada halaman 
                }else if($jum_halaman==1){ 
                   echo "<li class='page-item'><a class='page-link'>1</a></li>"; 
                }else{ 
                  $sebelum = $halaman-1; 
                  $setelah = $halaman+1; 
                  if($halaman!=1){ 
                    echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=1'>First</a></li>"; 
                    echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=$sebelum'>«</a></li>"; 
                  } 
                  // for($i=1; $i<=$jum_halaman; $i++){ 
                  //   if($i!=$halaman){ 
                  //     echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=$i'>$i</a></li>"; 
                  //   }else{ 
                  //     echo "<li class='page-item'><a class='page-link'>$i</a></li>"; 
                  //   } 
                  // } 
                  for($i=1; $i<=$jum_halaman; $i++){ 
                    if ($i < $halaman - 5 or $i > $halaman + 5 ) {
                      //do noting
                    }else if ($i==$halaman){
                      echo "<li class='page-item'><a class='page-link'>$i</a></li>"; 
                    }else if ($i!=$halaman){
                      echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=$i'>$i</a></li>"; 
                    } 
                  } 
                  // for($i=1; $i<=$jum_halaman; $i++){ 
                  //   if ($i > $halaman - 5 and $i < $halaman + 5 ) { 
                  //     if($i!=$halaman){ 
                  //       echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=$i'>$i</a></li>"; 
                  //     }else{ 
                  //          echo "<li class='page-item'><a class='page-link'>$i</a></li>"; 
                  //     } 
                  //   } 
                  // } 
                  if($halaman!=$jum_halaman){ 
                    echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=$setelah'>»</a></li>"; 
                    echo "<li class='page-item'><a class='page-link' href='$link?katakunci=$katakunci&halaman=$jum_halaman'>Last</a></li>"; 
                  } 
                }?> 
                </ul>
              </div>


<?php
include_once('../include/top.php');



$user_id = $_SESSION['user_id'];

//테스트


$stmt = $DB->prepare("select * from item where user_id=? and item_delete='N'");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$row = $stmt->get_result()->fetch_all();


$hidden_class = "";
if(sizeof($row) == 0) {

$hidden_class = "hidden";
}


?>

<div class="flex p-2 lg:p-8 flex-col lg:flex-row  bg-[#f2f2f2]"> 
    <article class="flex flex-col w-full lg:w-1/4 bg-[#ffffff] lg:mx-2 p-2 py-8 lg:rounded-xl">
        
            <h2 class="text-2xl font-semibold mb-2 w-full">SELLER</h2>
            <div class="w-full flex-row lg:flex-col flex">
                <a href="/product/product_edit.php" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#C65D7B] hover:text-[#ffffff] mt-2">상품 등록</a>
                <a href="#" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center bg-[#C65D7B] text-[#ffffff] mt-2">나의 상품</a>
            </div>
     
    </article>

    <article class="px-4 w-full lg:w-3/4 bg-[#ffffff] lg:mx-2 py-8">
            <h2 class="text-2xl font-semibold mb-4 w-full">나의 상품</h2>

                <div id="delete_btn_box" class="<?=$hidden_class?>text-[#000000] font-bold  text-right bg-[#f7f7f7] py-2 px-2 <?=$hidden_class?>" >
                    <span class="">
                        <input type="checkbox" name="check_all" id="check_all" style="position:absolute;left:-9999px" class="absolute left-[-9999px]">
                        <label for="check_all" class="cursor-pointer text-[13px] hover:text-[#C65D7B]" >전체선택</label>  
                    </span> 
                    <span class="text-[13px] cursor-pointer hover:text-[#C65D7B]" onclick="deleteALL();">
                        선택삭제
                    </span>    
                </div>

            <?php if (empty($row)) {?>
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    현재 등록한 상품이 없습니다.
            
                </div>

                <div class="h-[400px] w-full">

                </div>
            
            <?php
            }
            ?>

                
                <div id="item_box">
                    <?php foreach($row as $k=>$v){
                        

                        $stmt = $DB->prepare("select title from category where bcode=? and depth='0'");
                        $stmt->bind_param("s", $v[3]);  
                        $stmt->execute();
                        $crow = $stmt->get_result()->fetch_all();
                        $bmenu = $crow[0][0];

                        $stmt = $DB->prepare("select title from category where scode=? and depth='1'");
                        $stmt->bind_param("s", $v[4]);  
                        $stmt->execute();
                        $csrow = $stmt->get_result()->fetch_all();
                        $smenu = $csrow[0][0];
    
                    ?>
                        
                        <div class="bg-white mt-2 p-2 rounded border mb2">                 
                                <div class="chk_container flex mt-2 pb-2 py-1 my-1 flex-row ">
                                    
                                    <input type="hidden" id="no_625280c6a417a_cnt" value="65">
                                    <div class="flex w-[30%] lg:w-[10%] rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                                        <input type="checkbox" id="item_seq[<?=$k?>]" name="item_seq[<?=$k?>]" value="<?=$v[0]?>" class="chk w-[20px] h-[20px] md:w-[30px] md:h-[30px]" style="border-radius:30px">
                                    </div>
                                    <div class="flex w-[100%] lg:w-[20%] py-4 text-center flex-col justify-center items-center relative overflow-hidden mt-0 ">
                                        <img class="absolute top-0 left-0 w-full h-full object-cover md:object-top" src="img/<?=$v[6]?>" alt="img">
                                    </div>
                                
                                    <div class=" w-[100%] lg:w-[70%] pl-2 md:pl-4">

                                        <div class="text-[#000000] font-semibold lg:border-b py-1 my-1 justify-between flex flex-col lg:flex-row">
                                            <span class="text-[15px] text-ellipsis order-2 lg:order-1 overflow-hidden ...">
                                                <?=$v[5]?>                                
                                            </span> 
                                            
                                            <span class="text-[12px] order-1 lg:order-2 text-right">
                                            <a href="/product/product_update.php?item_code=<?=$v[2]?>" class="cursor-pointer hover:text-[#C65D7B]">수정</a>
                                            <a href="#" class="cursor-pointer hover:text-[#C65D7B]" onclick="deleteOne('<?=$v[0]?>','ONE','<?=$v[5]?>');"> 삭제</a>

                                            </span>    
                                        </div>

                                        
                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1  text-ellipsis overflow-hidden ...">
                                                분류                                 
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                            <?=$bmenu?> / <?=$smenu?>                               
                                            </span>  
                                        </div>

                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1 text-ellipsis overflow-hidden ...">
                                                가격                             
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                                <?=number_format($v[8])?> 원                               
                                            </span>  
                                        </div>

                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1 text-ellipsis overflow-hidden ...">
                                                할인률                          
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                                <?=$v[9]?> %                           
                                            </span>  
                                        </div>

                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1 text-ellipsis overflow-hidden ...">
                                            등록날짜                         
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                            <?=date("Y-m-d H:i" ,$v[12])?>                            
                                            </span>  
                                        </div>

                                    
                                    </div>
                                </div>
                        </div>
                    <?php } ?>
                </div>
    </article>
</div>



<script>


    //체크박스
    document.getElementById('check_all').onclick = function(){
        if($("input:checkbox[id='check_all']").prop("checked")){
            
            $("#item_box input").prop("checked", true);

        }else{
            $("#item_box input").prop("checked", false);

        };
    }

//장바구니 선택 삭제
    async function deleteALL(){
                let seq_arr = {};
                let mode = "ALL";

                let chk_arr = $(".chk");  
            
                for( let i=0; i<chk_arr.length; i++ ) { 
                    
                    if( chk_arr[i].checked == true ) {
                        seq_arr[i] = chk_arr[i].value;
                    } 
                }

          

                if(Object.keys(seq_arr).length == 0){ 
                    alert('삭제하실 상품을 선택해주세요'); return false;
                }
        

                if (confirm("선택 하신 항목들을 삭제하시겠습니까?") == false){   

                return false;

                }else{ 

                seq_arr = JSON.stringify(seq_arr); 
            
                
                let get_url = `item_delete_ajax.php`;
                let request_params = { 
                    seq_arr,
                    mode,
                }
                request_params = new URLSearchParams(request_params).toString(); 
                get_url = get_url+"?"+request_params;
                let res = await fetch(get_url);
                let data = await res.text();          
                document.getElementById("item_box").innerHTML = data;  
                alert(`${title} 상품이 삭제처리 되었습니다.`);
                if(document.querySelector('.chk_container') == null){
                    document.getElementById("delete_btn_box").classList.add('hidden');
                }
                
            }
            
        }



        
    //나의상품 개인삭제
    async function deleteOne(seq,mode,title){
        if (confirm(`${title} 상품을 삭제하시겠습니까?`) == false){   

            return false;

        }else{ 

        let get_url = `item_delete_ajax.php`;
        let request_params = { 
            seq,
            mode,
        }
        request_params = new URLSearchParams(request_params).toString(); 
        get_url = get_url+"?"+request_params;
        let res = await fetch(get_url);
        let data = await res.text();          
        document.getElementById("item_box").innerHTML = data;  
        alert(`${title} 상품이 삭제처리 되었습니다.`);
        if(document.querySelector('.chk_container') == null){
        document.getElementById("delete_btn_box").classList.add('hidden');
        
        }
        
    }
    
}

</script>
<?php
include_once('../include/bottom.php');
?>
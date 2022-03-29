<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<div id="test">
  <button>Clone</button>
  <input type="file" name="item_sub" class="red mt-2 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-black-50 file:text-black-700
                            hover:file:bg-black-100
                          "/>
</div>

<style>
  .red {
    width:20px;
    height:20px;
    background-color: red;
    margin: 10px;
  }
</style>



<script>

let img_cnt = 1;
 $('button').click(function() {
     $('.red').clone().appendTo('#test').prop('name', 'img_sub' + img_cnt);
     img_cnt++;
 });
</script>
<style>
.d-flex{
    display: flex;
}
.pagination {
  display: inline-block;
}
.container-paginacao{
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border-radius: 3px;
  margin: 0px 5px;
}
.pagination a:hover{
    background-color: #4CAF504A;
    cursor: pointer;
}
.pagination a.inativo:hover{
    cursor: context-menu;
    background: none;
}
.pagination a.active {
  background-color: #4CAF50;
  color: white;
}
.pagination a.active.inativo:hover{
    cursor: context-menu;
    background: #4CAF50;
}

.align-center{
    align-items: center;
}
</style>

<?php
$showPages = 3;
$result = [];
for ($x = $showPages;  $x >= 1; $x--) {
    $add = $currentPage - $x;
    if($add > 0)
        array_push($result, $add);
}

array_push($result, $currentPage);

for ($x = 1;  $x <= ($showPages); $x++) {
    $add = $currentPage + $x;
    if($add <= $lastPage)
        array_push($result, $add);
}
?>
<div class="d-flex container-paginacao">
    <div class="d-flex align-center">
        Total de itens:&nbsp;{{$total}}
    </div>
    <div class="d-flex">
        <div class="pagination">
            <a class=" paginador {{$currentPage == 1?'inativo':''}}" data-page='{{$currentPage - 1}}'>&laquo;</a>
            @foreach ($result as $item)
                <a class="paginador {{ ($item == $currentPage) ? 'active inativo':'' }}" data-page='{{$item}}'>{{$item}}</a>
            @endforeach
            <a class="paginador {{$currentPage == $lastPage ? 'inativo':''}}" data-page='{{$currentPage + 1}}'>&raquo;</a>
        </div>
    </div>
</div>

<script>
var paginadores = document.getElementsByClassName('paginador');
for(var i = 0; i < paginadores.length; i++) {
    (function(index) {
        paginadores[index].addEventListener('click', function(){
            if(!paginadores[index].classList.contains('inativo')){
                var url = new URL(window.location.href);
                url.searchParams.set('page', paginadores[index].getAttribute('data-page'));
                window.location.href = url.toString();
            }
        });
    })(i);
}
</script>
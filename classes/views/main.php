<div class="buy-list">
    <div id="add-list-item">
        <button class="btn btn-primary btn-lg"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>


    <table id="mytab" class="table table-hover">

        <thead>
        <tr style="font-size: 15px; color:#000080;">
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">Название продукта</th>
            <th scope="col">Стоимость, руб.</th>
            <th scope="col">Количество</th>
            <th scope="col">Итого, руб.</th>
        </tr>
        </thead>

        <tbody>

        <tr class = "row1">

            <th scope="row" ><input type="checkbox" id="button"></th>

            <td>1</td>
            <td><span>Хлеб</span></td>
            <td>10</td>
            <td>22</td>
            <td></td>

        </tr>


        <tr class = "row1">
            <th scope="row" ><input type="checkbox" id="button"></th>
            <td>2</td>
            <td>Молоко</td>
            <td>33</td>
            <td>10</td>
            <td></td>
        </tr>

        <tr class = "row1">
            <th scope="row" ><input type="checkbox" id="button"></th>
            <td>3</td>
            <td>Сметана</td>
            <td>25</td>
            <td>5</td>
            <td></td>
        </tr>

        </tbody>

    </table>
    <table id="totaltab" class="table table-hover">
        <thead>
        <tr style="font-size: 15px; color:#000080;">
            <th scope="col">ЗАПЛАНИРОВАНО СУММА</th>
            <th scope="col" style = "width: 83px;" ></th>

        </tr>
        <tr style="font-size: 15px; color:#000080;">
            <th scope="col">ПОТРАЧЕНО СУММА</th>
            <th scope="col"><form style = "margin-top: 0px;" name="test" method="post" action="#">
                    <input type="text" size="4">
                </form></th>

        </tr>
        <tr style="font-size: 15px; color:#000080;">
            <th scope="col">СЭКОНОМЛЕНО СУММА</th>
            <th scope="col"></th>

        </tr>
        </thead>
    </table>
    
    <input type="button" name="123" id="table" value="TEST Summa" onclick="myFunction()">

    <div class="buy-list-item">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Хлеб</span>
        </label>
    </div>
    <div class="buy-list-item">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Молоко</span>
        </label>
    </div>
    <div class="buy-list-item">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Яйца</span>
        </label>
    </div>
    <div class="buy-list-item">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Мука</span>
        </label>
    </div>
    <div class="buy-list-item">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Сахар</span>
        </label>
    </div>
</div>
<div id="search-list-item" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form action="#">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Видите название товара">
                        <span class="input-group-btn">
                                <button class="btn btn-primary" type="reset"><i class="fa fa-times"></i></button>
                            </span>
                    </div>
                </form>
            </div>
            <div class="modal-body">
                <a href="#" class="badge badge-primary">Молоко</a>
                <a href="#" class="badge badge-primary">Хлеб</a>
                <a href="#" class="badge badge-primary">Соль</a>
                <a href="#" class="badge badge-primary">Сахар</a>
                <a href="#" class="badge badge-primary">Оливки</a>
                <a href="#" class="badge badge-primary">Курага</a>
                <a href="#" class="badge badge-primary">Сок</a>
                <a href="#" class="badge badge-primary">Сметана</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
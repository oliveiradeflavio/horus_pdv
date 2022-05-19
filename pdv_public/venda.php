<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- cdn bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
    <!-- css -->
    <link rel="stylesheet" href="css/venda.css">

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Venda</title>
</head>
<body>
<div class="container">
    <div class="row">

    <div class='col-md-6'>
        <img src="img/produto_sem_imagem.png" class="imagem_produto" alt="">

        <select class="form-control" name="" id="">
            <option value="">Selecione um cliente</option>
            <option value="">Cliente 1</option>
            <option value="">Cliente 2</option>
            <option value="">Cliente 3</option>
        </select>
         

        <select class="form-control" name="" id="">
            <option value="">Selecione um produto</option>
            <option value="">Produto 1</option>
            <option value="">Produto 2</option>
            <option value="">Produto 3</option>
        </select>
         
        <input type="number" class="form-control" name="" id="" value="1" placeholder="Quantidade">

    <div class="row">
        <div class="col-md-6">
            <label for="">Preço Unitário</label>
            <input type="text" class="form-control" name="" id="" value="R$ 0,00" disabled>
        </div>
        <div class="col-md-6">
            <label for="">Preço Total</label>
            <input type="text" class="form-control" name="" id="" value="R$ 0,00" disabled>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-success btn-block">Adicionar</button>
        </div>
        <div class="col-md-6">
            <button class="btn btn-danger btn-block">Remover</button>
        </div>
    </div>
      
    </div>

    <div class="col-md-6">
        <div class="">
        <table class="table table-hover .table-borderless table-responsive">
                <thead>
                    <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço Unitário</th>
                    <th scope="col">Preço Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Produto 1</td>
                    <td>1</td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    
                    </tr>

                    <tr>
                    <td>Produto 2</td>
                    <td>1</td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    </tr>

                    <tr>
                    <td>Produto 3</td>
                    <td>1</td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    </tr>

                    <tr>
                    <td>Produto 4</td>
                    <td>1</td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    </tr>

                    <tr>
                    <td>Produto 5</td>
                    <td>1</td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    </tr>

                    <tr>
                    <td>Produto 6</td>
                    <td>1</td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    </tr>
   
                </tbody>
      </table>


        </div>

        <div class="row">               
                <div class="col-md-6">
                    <label for="">Desconto</label>
                    <input type="text" class="form-control" name="" id="" value="R$ 0,00" disabled>
                </div>
                <div class="col-md-6">
                    <label for="">Total a pagar</label>
                    <input type="text" class="form-control" name="" id="" value="R$ 0,00" disabled>
                </div>
                </div>
           
            <div class="row ml-5">
                <div class="col-md-6">
                    <button class="btn btn-success btn-block">Finalizar Venda</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger btn-block">Cancelar Venda</button>
                </div>
            </div>
    </div>

    </div>
</div>

<div class="container footer">
    <div class="row">
       <div class="col-md-6">
           
       </div>

       <div class="col-md-6">
           
       </div>
    </div>


</div>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
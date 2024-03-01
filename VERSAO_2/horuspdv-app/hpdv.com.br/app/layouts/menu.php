<nav>
    <div id='menu'>
        <button class="btn btn-enter" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSuperior" aria-controls="offcanvasTop">Menu</button>
    </div>
    <div class="offcanvas offcanvas-top" tabindex="-1" id="menuSuperior" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel">nome_usuario_logado</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <ul class="menu-container">
                    <li class="menu-box" onclick="window.location.href='home';">
                        <a href="home">
                            <i class="fa-solid fa-house"></i>
                            Home</a>
                        </a>
                    </li>
                    <div class="menu-box dropbottom">
                        <li class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-address-card"></i>
                            Cadastros
                        </li>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="cadastro-cliente"><i class="fa-solid fa-user-plus"></i> Cliente</a></li>
                            <li><a class="dropdown-item" href="cadastro-produto"><i class="fa-solid fa-tags"></i> Produto</a></li>
                            <li><a class="dropdown-item" href="cadastro-fornecedor"><i class="fa-solid fa-truck-fast"></i> Fornecedor</a></li>
                        </ul>
                    </div>

                    <li class="menu-box">
                        <a href="#">
                            <i class="fa-solid fa-chart-line"></i>
                            Dashboard</a>
                        </a>
                    </li>
                    <li class="menu-box">
                        <a href="historico-de-vendas">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            Histórico de Vendas</a>
                        </a>
                    </li>
                    <li class="menu-box">
                        <a href="relatorio">
                            <i class="fa-solid fa-file-invoice"></i>
                            Relatórios</a>
                        </a>
                    </li>
                    <li class="menu-box">
                        <a href="vendas" target="_blank">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                            Iniciar Vendas</a>
                        </a>
                    </li>

                    <div class="menu-box dropbottom">
                        <li class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-gear"></i>
                            Configurações
                        </li>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-gear"></i> Editar Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i> Detalhes da Licença</a></li>

                        </ul>
                    </div>

                    <li class="menu-box" onclick="window.location.href='sair';">
                        <a href="sair">
                            <i class="fa-solid fa-person-walking-arrow-right"></i>
                            Sair / Efetuar logoff</a>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="loader-container"></div>
<nav>
    <div id='menu'>
        <button class="btn btn-enter" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSuperior" aria-controls="offcanvasTop">Menu</button>
    </div>
    <div class="offcanvas offcanvas-top" tabindex="-1" id="menuSuperior" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel"><?= $user_logged->usuario_acesso ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <ul class="menu-container">
                    <li class="menu-box" onclick="window.location.href='home';">
                        <a href="home">
                            <i class="fa-solid fa-house menu-icon"></i>
                            Home</a>
                        </a>
                    </li>
                    <div class="menu-box dropbottom">
                        <li class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-address-card"></i>
                            Cadastros
                        </li>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li onclick="window.location.href='cadastro-cliente';"><a class="dropdown-item" href="cadastro-cliente"><i class="fa-solid fa-user-plus menu-icon"></i> Cliente</a></li>
                            <li onclick="window.location.href='cadastro-produto';"><a class="dropdown-item" href="cadastro-produto"><i class="fa-solid fa-tags menu-icon"></i> Produto</a></li>
                            <li onclick="window.location.href='cadastro-fornecedor';"><a class="dropdown-item" href="cadastro-fornecedor"><i class="fa-solid fa-truck-fast menu-icon"></i> Fornecedor</a></li>
                        </ul>
                    </div>
                    <li class="menu-box" onclick="window.location.href='historico-de-vendas';">
                        <a href="historico-de-vendas">
                            <i class="fa-solid fa-clock-rotate-left menu-icon"></i>
                            Histórico de Vendas</a>
                        </a>
                    </li>
                    <li class="menu-box" onclick="window.location.href='relatorio';">
                        <a href="relatorio">
                            <i class="fa-solid fa-file-invoice menu-icon"></i>
                            Relatórios</a>
                        </a>
                    </li>
                    <li class="menu-box" onclick="window.location.href='vendas';">
                        <a href="vendas" target="_blank">
                            <i class="fa-solid fa-cart-arrow-down menu-icon"></i>
                            Iniciar Vendas</a>
                        </a>
                    </li>

                    <div class="menu-box dropbottom">
                        <li class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-gear menu-icon"></i>
                            Configurações
                        </li>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li onclick="window.location.href='conta-de-usuario';"><a class="dropdown-item" href="conta-de-usuario"><i class="fa-solid fa-users menu-icon"></i> Contas de Usuários</a></li>
                            <li onclick="window.location.href='detalhe-licenca';"><a class="dropdown-item" href="detalhe-licenca"><i class="fa-solid fa-key menu-icon"></i> Detalhes da Licença</a></li>
                            <li onclick="window.location.href='editar-perfil';"><a class="dropdown-item" href="editar-perfil"><i class="fa-solid fa-user-gear menu-icon"></i> Editar Perfil</a></li>
                        </ul>
                    </div>

                    <li class="menu-box" onclick="window.location.href='sair';">
                        <a href="sair">
                            <i class="fa-solid fa-person-walking-arrow-right menu-icon"></i>
                            Sair / Efetuar logoff</a>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="loader-container"></div>
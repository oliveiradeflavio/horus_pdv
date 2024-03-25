<?php
session_start();
session_unset(); //limpa todas as variáveis de sessão
session_destroy(); //destroi a sessão
header('Location: login');
exit();

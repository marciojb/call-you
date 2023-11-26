<?php
include_once('../config/config.php');

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM usuario WHERE id LIKE '%$data%' or nome LIKE '%$data%' or login LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM usuario ORDER BY id DESC";
}
$result = $conexao->query($sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Document</title>
</head>

<body>
    <!-- header-->
    <?php require_once '../componentes/header.php'; ?>
    <main>
        <h1 id="titulo_users"> Consulta de usuários</h1><br>

        <div class="box-search">
            <input type="search" class="form-control w-25" placeholder="Pesquisar..." id="pesquisar">
            <button onclick="searchData()" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </div>
        <div class="Consulta_user">
            <section id="container_user">
                <table class=" Consulta_table table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">login</th>
                            <th scope="col">nome</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            while ($user_Data = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<th>" . $user_Data['id'] . "</th>";
                                echo "<td>" . $user_Data['login'] . "</td>";
                                echo "<td>" . $user_Data['nome'] . "</td>";
                                echo "<td>
                                        <a href='../paginas/detalhe.php?id=" . $user_Data['id'] . "'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search trash-icon1' viewBox='0 0 16 16'>
                                                <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z' />
                                            </svg>
                                        </a>
                                        <a href='javascript:void(0)' onclick='confirmDelete(" . $user_Data['id'] . ")'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill trash-icon' viewBox='0 0 16 16'>
                                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                                            </svg>
                                        </a>
                            </td>";
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
    <!-- footer-->
    <?php require_once '../componentes/footer.php'; ?>
    <script>function confirmDelete(userId) {
        
    Swal.fire({
        title: "Você tem certeza?",
        text: "Não tem como reverter",
        icon: "perigo",
        showCancelButton: true,
        confirmButtonText: "Sim, delete!",
        cancelButtonText: "Não,cancela",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Se o usuário confirmar, redirecione para a página de exclusão
            window.location.href = '../paginas/delete.php?id=' + userId;
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelado",
                text: "Esta tudo bem,agora :)",
                icon: "error"
            });
        }
    });
}
</script>
    <script src="../script/search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
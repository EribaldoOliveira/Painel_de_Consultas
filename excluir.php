<?php
require("conexao.php");

$id = $_POST['id'];

$delete = mysqli_query($conexao,"DELETE FROM salas where id = '".$id."'") or die (mysqli_error($conexao));
if  (mysqli_affected_rows($conexao) > 0){
    ?>
<table class="table-bordered" style="width:100%;">
    <thead>
        <th>Sala</th>
        <th>Profissional</th>
        <th>Apelido</th>
        <th>Ação</th>
    </thead>
    <tbody>
        <?php
            $sql = mysqli_query($conexao,"SELECT * FROM salas order by nome_sala") or die (mysqli_error($conexao));
            while ($ret = mysqli_fetch_assoc($sql)){
                ?>

        <tr>
            <input type="hidden" name="" class="id" value="<?php echo $ret['id'] ;?>">
            <td><?php echo $ret['nome_sala'];?></td>
            <td><?php echo $ret['profissional'];?></td>
            <td><?php echo $ret['apelido'];?></td>
            <td><button class='btn btn-outline-warning editar'>Editar</button><button
                    class="btn btn-outline-danger excluir">EXCLUIR</button></td>
        </tr>
        <?php
            }
            
            ?>
    </tbody>
</table>
<?php
}
    ?>
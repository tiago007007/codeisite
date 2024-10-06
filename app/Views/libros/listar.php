<?=$cabecera?>
    <a class="btn btn-success" href="<?=base_url('crear')?>">Crear un Libro</a>
</br>
</br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>imagen</th>
                    <th>nombre</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($libros as $libro): ?>
                    <tr>
                        <td><?=$libro['id']?></td>
                        <td>
                            <img class="img-thumbnail" src="<?=base_url()?>/uploads/<?=$libro['imagen']?>" width="100" alt="">
                        </td>
                        <td><?=$libro['nombre']?></td>
                        <td>
                        <a href="<?=base_url('editar/'.$libro['id'])?>" class="btn btn-success" type="button">Editar</a>
                            <a href="<?=base_url('borrar/'.$libro['id'])?>" class="btn btn-danger" type="button">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?=$piepagina?>
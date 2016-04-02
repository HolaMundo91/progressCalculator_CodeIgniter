<?php
$juegos = $this->games->juegos( array(
    'disponibilidad' => 1,
));

$datos = $this->users->get( array('id' => $this->user_id), $buscar = true);

echo form_open();
echo validation_errors();

echo '<table>';

$recoger = 1;
foreach( $juegos->result() as $jueguito ){
    
    //jQuery de las barras
    ?>
    <script type="text/javascript">
    $(document).ready(function()
        {
            $( '#<?php echo $jueguito->id; ?>' ).change(function(){
                $( '#<?php echo $jueguito->name; ?>' ).val( $('#<?php echo $jueguito->id; ?>').val() );
            });
        });
    </script>
    <?php
    
    echo '<tr>';
        echo '<td>';
            echo form_label( $jueguito->name, 'juego_name' );
        echo '</td>';
    
        echo '<td>';
            echo form_input( array(
                'id'    => $jueguito->id,
                'name'  => $recoger,
                'type'  => 'range',
                'min'   => '0',
                'max'   => $datos->unused_points,
                'step'  => '1',
                'value' => '0',
            ));
        echo '</td>';
        
        echo '<td>';
            echo form_input( array(
                'id'        => $jueguito->name,
                'name'      => 'valor',
                'type'      => 'text',
                'value'     => '0',
                'disabled'  => true,
            ));
        echo '</td>';
    echo '</tr>';
    
    $recoger++;
}

    echo '<tr>';
        echo '<td></td>';
        
        echo '<td style="text-align: right;"> Total: </td>';

        echo '<td>';
            echo form_input( array(
                'id'        => 'puntos_totales',
                'name'      => 'total_de_puntos',
                'type'      => 'text',
                'value'     => '0',
                'disabled'  => true,
            ));
        echo '</td>';
    echo '</tr>';
echo '</table>';
    
echo form_submit( array(
    'value' => 'Asignar puntos',
    'name'  => 'asignar_puntos',
));
    
echo form_close();

//jQuery para el campo TOTAL
$juegos = $this->games->juegos( array(
    'disponibilidad' => 1,
));
?>
<script type="text/javascript">
$(document).ready(function()
    {
        //variable en la que alcenaremos los valores de los campos
        var recolector = 0;
        
        <?php
        //comprobamos si alguna de las barras ha cambiado de valor
        foreach( $juegos->result() as $jueguito ){ ?>
               
            //si alguna barra ha cambiado de valor
            $( '#<?php echo $jueguito->id; ?>' ).change(function(){ <?php
                $juegos = $this->games->juegos( array('disponibilidad' => 1,)); ?>
                recolector = 0;  
                
                <?php
                //recorremos los 2 campos y metemos sus valores en 'recolector'
                foreach( $juegos->result() as $jueguito ){ ?>
                     
                     recolector = parseInt(recolector) + parseInt( $( '#<?php echo $jueguito->id; ?>' ).val() );
                     //mostramos en el campo con ID #puntos_totales el resultado de la suma
                     $('#puntos_totales').val(recolector);
                     
                <?php
                } ?>
        }); <?php
        
        } ?>
    });
</script>
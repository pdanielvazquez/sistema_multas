/*me trae todos los datos de una multa para poder*/
SELECT m.folio,m.fecha_creada,m.fecha_limite,e.nombre as etiqueta,p.nombre as personal,m.multado as id_multado,l.nombre as nombre_multado,x.no_materiales as cantidad,inventario,material,otro,descripcion
from multas m INNER JOIN etiqueta e 
on m.etiqueta=e.id_etiqueta INNER JOIN personal p 
on m.tipo_personal=p.id_personal INNER JOIN lista l
on m.multado=l.id INNER JOIN (SELECT m.multa,COUNT(id)as no_materiales,GROUP_CONCAT(m.no_inventario)as inventario,GROUP_CONCAT(m.material) as material,GROUP_CONCAT(m.otro) as otro,
                                GROUP_CONCAT(m.descripcion) as descripcion
                                from materiales m
                                WHERE m.multa=1) as x
on x.multa=m.folio                     
WHERE m.folio=1


/*Para la dataTable de multas*/

SELECT m.folio,m.fecha_creada,m.fecha_limite as 'fecha vencido',e.nombre as etiqueta,p.nombre as personal,m.multado as id_multado,l.nombre as nombre_multado,m.total as cobrado 
from multas m INNER JOIN etiqueta e 
on m.etiqueta=e.id_etiqueta INNER JOIN personal p 
on m.tipo_personal=p.id_personal INNER JOIN lista l 
on m.multado=l.id
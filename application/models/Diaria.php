<?php
namespace Central\Domain\Entity ;


/**
 * @Entity
 * @Table(name="tb_diaria")
 * @author Arthur Cláudio de Almeida Pereira < arthur.almeidapereira@gmail.com >
 *
 */
class Diaria extends AbstractEntity {
	
	/**
     * @Id 
     * @Column(type="integer", name="id_diaria") 
     * @GeneratedValue
     */
	protected $id;
	
	/**
	 * @Column(type="float", name="valor_diaria")
	 */
	protected $valorDiaria;
	
	public function __construct( $valor ) {
		if( !is_float($valor) || $valor === 0 ){
			throw new InvalidArgumentException( 'Informe um valor correto e diferente de zero ' );
		}
		
		$this->valorDiaria = $valor;
	}
	
}
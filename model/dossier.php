<?php
/** @Entity @Table(name="dossiers") */
class Dossier{
	/** @Id @Column(type="integer") @GeneratedValue */
	public $id;
	/** @Column(type="string", nullable=true) */
	public $etat_civil;
	/** @Column(type="string", nullable=true) */
	public $coords;
	/** @Column(type="string", nullable=true) */
	public $antc;
	/** @Column(type="string", nullable=true) */
	public $vaccins;
	/** @OneToOne(targetEntity="User", inversedBy="dossier", cascade={"persist","remove"})
	* 	@JoinColumn(name="user_login",referencedColumnName="login")
	 */
	public $user;
}

?>
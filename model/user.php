<?php
/** @Entity @Table(name="users") */
 class User{

 	/** @Id @Column(type="string") */
 	public $login;
 	/** @Column(type="string") */
 	public $password;
 	/** @OneToOne(targetEntity="Dossier", mappedBy="user", cascade={"persist","remove"}) */
 	public $dossier;

 }


?>
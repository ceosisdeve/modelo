<?php
/**
 * Created by PhpStorm.
 * User: junior
 * Date: 08/05/15
 * Time: 13:37
 */

namespace Admin\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Acesso
 *
 * @ORM\Table(name="acesso")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Admin\Entity\Repository\AcessoRepository")
 */
class Acesso extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $ip;

    /**
     * @ORM\Column(type="string")
     */
    protected $agente;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Usuarios", inversedBy="acessos")
     * @ORM\JoinColumn(nullable=false, onDelete="RESTRICT")
     */
    protected $usuario;

    /**
     * Retorna o campo $ip
     * @return $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Seta o campo $ip
     * @param field_type $ip
     * @return Acesso
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * Retorna o campo $usuario
     * @return $usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Seta o campo $usuario
     * @param field_type $usuario
     * @return Compra
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getAgente()
    {
        return $this->agente;
    }

    public function setAgente($agente)
    {
        $this->agente = $agente;
        return $this;
    }
}
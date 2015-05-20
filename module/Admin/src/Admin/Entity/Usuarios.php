<?php

namespace Admin\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ZfcUser\Entity\UserInterface as ZfcUserInterface;
use ZfcRbac\Identity\IdentityInterface;

/**
 * Usuarios
 * @author Winston Hanun Júnior
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Admin\Entity\Repository\UsuariosRepository")
 */
class Usuarios extends AbstractEntity implements ZfcUserInterface, IdentityInterface
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmesenha", type="string", length=45, nullable=true)
     */
    private $confirmesenha;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=50, nullable=true)
     */
    private $displayName;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="smallint", nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="permissao", type="string", length=32, nullable=false)
     */
    private $permissao = 'visitante';

    /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\Acesso", mappedBy="usuario")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $acessos;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=15, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=15, nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=10, nullable=true)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=2, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=100, nullable=true)
     */
    private $cidade;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=100, nullable=true)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=200, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento", type="string", length=200, nullable=true)
     */
    private $complemento;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=true)
     */
    private $activationKey;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_alteracao", type="datetime", nullable=true)
     */
    private $dataAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cadastro", type="datetime", nullable=true)
     */
    private $dataCadastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    public function __construct()
    {
        $this->acessos = new ArrayCollection();
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Usuarios
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return Usuarios
     */
    public function setDisplayName($displayName)
    {
        return $this->getNome();
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set confirmesenha
     *
     * @param string $confirmesenha
     *
     * @return Usuarios
     */
    public function setConfirmesenha($confirmesenha)
    {
        $this->confirmesenha = $confirmesenha;

        return $this;
    }

    /**
     * Get confirmesenha
     *
     * @return string
     */
    public function getConfirmesenha()
    {
        return $this->confirmesenha;
    }

    public function getAcessos()
    {
        return $this->acessos;
    }

    public function setAcessos($acessos)
    {
        $this->acessos = $acessos;
        return $this;
    }

    public function addAcessos(Collection $acessos)
    {
        foreach ($acessos as $acesso) {
            $acesso->setUsuario($this);
            $this->acessos->add($acesso);
        }
    }

    public function removeAcessos(Collection $acessos)
    {
        foreach ($acessos as $acesso) {
            $this->acessos->removeElement($acesso);
        }
    }

    public function addAcesso($acesso)
    {
        foreach ($this->acessos as $tok) {
            if ($tok->getId() == $acesso->getId()) {
                return $this;
            }
        }
        $this->acessos[] = $acesso;
        return $this;
    }



    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Usuarios
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set permissao
     *
     * @param string $permissao
     *
     * @return Usuarios
     */
    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;

        return $this;
    }

    /**
     * Get permissao
     *
     * @return string
     */
    public function getPermissao()
    {
        return $this->permissao;
    }

    /**
     * Get the list of roles of this identity
     *
     * @return string[]|\Rbac\Role\RoleInterface[]
     */
    public function getRoles()
    {
        return array(
            $this->permissao
        );
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Usuarios
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return Usuarios
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set cep
     *
     * @param string $cep
     *
     * @return Usuarios
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Usuarios
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     *
     * @return Usuarios
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     *
     * @return Usuarios
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     *
     * @return Usuarios
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     *
     * @return Usuarios
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento
     *
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set activationKey
     *
     * @param string $activationKey
     *
     * @return Usuarios
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;

        return $this;
    }

    /**
     * Get activationKey
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Usuarios
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set dataAlteracao
     *
     * @param \DateTime $dataAlteracao
     * @ORM\PreUpdate
     *
     * @return Usuarios
     */
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = new \DateTime('now');

        return $this;
    }

    /**
     * Get dataAlteracao
     *
     * @return \DateTime
     */
    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     * @ORM\PrePersist
     *
     * @return Usuarios
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = new \DateTime('now');

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Usuarios
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }



    /**
     * Set id.
     *
     * @param int $id
     * @return ZfcUserInterface
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }
}

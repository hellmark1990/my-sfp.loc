<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\FileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class File
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="folder_id", type="integer")
     */
    private $folderId;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="text")
     */
    private $src;

    /**
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="files")
     * @ORM\JoinColumn(name="folder_id", referencedColumnName="id")
     */
    private $folder;

    /**
     * @var integer
     *
     * @ORM\Column(name="cloud_id", type="integer")
     */
    private $cloud_id;

    /**
     * @ORM\ManyToOne(targetEntity="Cloud", inversedBy="files")
     * @ORM\JoinColumn(name="cloud_id", referencedColumnName="id")
     */
    private $cloud;

    /**
     * @var string
     */
    private $path;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @ORM\PostLoad()
     */
    public function setPath()
    {
        $this->path = $this->getFolder()->getPath() . '\\' . $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set folderId
     *
     * @param integer $folderId
     * @return File
     */
    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;

        return $this;
    }

    /**
     * Get folderId
     *
     * @return integer
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * Set src
     *
     * @param string $src
     * @return File
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set folder
     *
     * @param \AppBundle\Entity\Folder $folder
     * @return File
     */
    public function setFolder(\AppBundle\Entity\Folder $folder = null)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return \AppBundle\Entity\Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set cloud_id
     *
     * @param integer $cloudId
     * @return File
     */
    public function setCloudId($cloudId)
    {
        $this->cloud_id = $cloudId;

        return $this;
    }

    /**
     * Get cloud_id
     *
     * @return integer
     */
    public function getCloudId()
    {
        return $this->cloud_id;
    }

    /**
     * Set cloud
     *
     * @param \AppBundle\Entity\Cloud $cloud
     * @return File
     */
    public function setCloud(\AppBundle\Entity\Cloud $cloud = null)
    {
        $this->cloud = $cloud;

        return $this;
    }

    /**
     * Get cloud
     *
     * @return \AppBundle\Entity\Cloud
     */
    public function getCloud()
    {
        return $this->cloud;
    }
}

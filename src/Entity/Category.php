<?php

namespace App\Entity;

use App\Enum\GenderEnum;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: BlogPost::class)]
    private $blogPosts;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    public function __construct()
    {
        $this->blogPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, BlogPost>
     */
    public function getBlogPosts(): Collection
    {
        return $this->blogPosts;
    }

    public function addBlogPost(BlogPost $blogPost): self
    {
        if (!$this->blogPosts->contains($blogPost)) {
            $this->blogPosts[] = $blogPost;
            $blogPost->setCategory($this);
        }

        return $this;
    }

    public function removeBlogPost(BlogPost $blogPost): self
    {
        if ($this->blogPosts->removeElement($blogPost)) {
            // set the owning side to null (unless already changed)
            if ($blogPost->getCategory() === $this) {
                $blogPost->setCategory(null);
            }
        }

        return $this;
    }

    public function toString(object $object): string
    {
        return $object instanceof Category
            ? $object->getName()
            : 'Category'; // shown in the breadcrumb on the create view
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getType(): ?GenderEnum
    {
        if ($this->type) {
            return GenderEnum::from($this->type);
        }
        return null;
    }

    public function setType(GenderEnum $type): self
    {
        $this->type = $type->value;

        return $this;
    }
}

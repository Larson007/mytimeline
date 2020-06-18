<?php

namespace App\Entity;

use App\Repository\TimeLineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimeLineRepository::class)
 */
class TimeLine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $events;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eras;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $scale;

    /**
     * @ORM\Column(type="integer")
     */
    private $start_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $groups;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $display_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autolink;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $unique_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="timeLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Theme::class, mappedBy="timelines")
     */
    private $themes;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="timeline")
     */
    private $event;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
        $this->event = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getEvents(): ?string
    {
        return $this->events;
    }

    public function setEvents(string $events): self
    {
        $this->events = $events;

        return $this;
    }

    public function getEras(): ?string
    {
        return $this->eras;
    }

    public function setEras(?string $eras): self
    {
        $this->eras = $eras;

        return $this;
    }

    public function getScale(): ?string
    {
        return $this->scale;
    }

    public function setScale(?string $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function getStartDate(): ?int
    {
        return $this->start_date;
    }

    public function setStartDate(int $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?int
    {
        return $this->end_date;
    }

    public function setEndDate(?int $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getGroups(): ?string
    {
        return $this->groups;
    }

    public function setGroups(?string $groups): self
    {
        $this->groups = $groups;

        return $this;
    }

    public function getDisplayDate(): ?string
    {
        return $this->display_date;
    }

    public function setDisplayDate(?string $display_date): self
    {
        $this->display_date = $display_date;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getAutolink(): ?string
    {
        return $this->autolink;
    }

    public function setAutolink(?string $autolink): self
    {
        $this->autolink = $autolink;

        return $this;
    }

    public function getUniqueId(): ?int
    {
        return $this->unique_id;
    }

    public function setUniqueId(?int $unique_id): self
    {
        $this->unique_id = $unique_id;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->addTimeline($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->themes->contains($theme)) {
            $this->themes->removeElement($theme);
            $theme->removeTimeline($this);
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
            $event->setTimeline($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->event->contains($event)) {
            $this->event->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getTimeline() === $this) {
                $event->setTimeline(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}

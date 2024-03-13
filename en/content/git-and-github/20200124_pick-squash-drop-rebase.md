---
title: Pick. Squash. Drop. Rebase! (Comic)
published: true
description: It is a common practice to use `git rebase` to squash commits before creating or merging a pull request; nobody needs to see that you fixed 10 typos in 5 separate commits, and keeping that history is of no use. So how does a rebase look like?
series: Git Illustrated
tags: git, beginners, illustrated, comics
cover_image: https://thepracticaldev.s3.amazonaws.com/i/mipao0n3oqno93o22s7f.png
---

_Originally published on [Dev.to](https://dev.to/erikaheidi/pick-squash-drop-rebase-comic-607)._

[Git Rebase](https://git-scm.com/docs/git-rebase) allows us to rewrite Git history. It is a common practice to use `git rebase` to squash commits before creating or merging a pull request; nobody needs to see that you fixed 10 typos in 5 separate commits, and keeping that history is of no use. So how does a rebase look like?

![Git Rebase Comic](https://thepracticaldev.s3.amazonaws.com/i/fbah0r4533nv72y2wgiz.png)

Let's imagine you have your deck of cards, they are ordered in a certain way that cannot be changed. Each card represents a commit in a project's branch.

When running an interactive rebase with `rebase -i`, there are mainly three actions we may want to perform in a commit (card):

- **p**ick: pick a commit.
- **s**quash: squash this commit into the previous one.
- **d**rop: drop this commit altogether.

In this game, you want to **s**quash cards together into doubles and triples. Some cards make sense on their own, so you will **p**ick them. Sometimes, a card should not even be there, so you might want to **d**rop it.

Although there are other ways of using `git rebase`, the interactive rebase used like this is a common practice observed in projects that rely on multiple contributors, both in open as well as in closed source. It enables you to commit earlier and with more frequency, because you are able to edit your history before submitting your pull request.

If you'd like a deeper introduction to Git Rebase, please check this great dev article from [@maxwell_dev](https://dev.to/maxwell_dev):

{% post https://dev.to/maxwell_dev/the-git-rebase-introduction-i-wish-id-had %} 

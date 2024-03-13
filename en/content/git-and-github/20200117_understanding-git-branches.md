---
title: Understanding Git Branches (Illustrated)
published: true
description: When multiple developers need to work in the same Git repository, it is important to define a process that allows collaboration. That's when branches become essential. 
tags: git, beginners, illustrated, comics
series: Git Illustrated
cover_image: https://thepracticaldev.s3.amazonaws.com/i/ban08i3ij12b7zv7ad1e.jpg
---

_Originally published on [Dev.to](https://dev.to/erikaheidi/understanding-git-branches-illustrated-ggh)._

In a [previous post](https://dev.to/erikaheidi/stage-commit-push-a-git-story-comic-a37), we talked about the process of submitting changes to a remote Git repository. We've seen that this process is done in three steps: 1) stage. 2) commit. 3) push.

In a small project with a solo contributor, it's not uncommon that these changes are pushed directly into `master`. But when multiple developers need to work in the same Git repository, it is important to define a process that leverages parallel collaboration. That's when **branches** become essential.

![Git Tree Illustration](https://thepracticaldev.s3.amazonaws.com/i/7ph91rcm4nkmna10eqmb.jpg)

>Not all trees are the same, but they all start small. In a typical Git repository, code grows as a tree. Features are implemented in development branches that are eventually **merged** into a **master** branch.

Whenever working on a team, whether if it's in an open source project or a corporate setting, it's always a good practice to create a new branch (usually based on `master`) and start from there.

Once you're finished with your changes, you can then push your branch to the remote repository and create a new **pull request**. A **pull request** is a formal request for merging your branch into `master`.

![Pull Request Mando and Baby Yoda](https://thepracticaldev.s3.amazonaws.com/i/26ehw0t3trfmuc4jlmw8.jpg)

> Although it is possible to push and merge a branch directly into "master", creating a pull request is usually the way to go when suggesting changes in a codebase.

Opening a pull request creates an opportunity for code review and actionable feedback; that's why it became a standard procedure for collaborating in most open source projects.

---

For a more in-depth understanding of Git branches, please check [these docs](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell) or have a look at this [quick reference guide](https://dev.to/digitalocean/how-to-use-git-a-reference-guide-6b6).

Any Git topic you'd like to understand better? Leave your suggestion for my next comic in the comments :)

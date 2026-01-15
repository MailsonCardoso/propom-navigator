---
description: Rebuild and Push for Production (cPanel)
---

Whenever changes are made to the frontend (`src/` folder), follow these steps to ensure the production build is updated:

1.  **Build the project** locally:
    ```bash
    npm run build
    ```
2.  **Add all changes**, including the `dist` folder:
    ```bash
    git add .
    ```
3.  **Commit** with a descriptive message:
    ```bash
    git commit -m "Update: [Description] (and production build)"
    ```
4.  **Push** to the repository:
    ```bash
    git push
    ```

*Note: The `dist` folder must be included because it is used for direct deployment via cPanel.*

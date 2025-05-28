Ah, I see the confusion! That line:

```bash
*.php linguist-language=PHP
```

is **not** meant to be typed into PowerShell or any terminal. It's a **line of text** that you need to **place inside a file** named `.gitattributes` in the **root folder** of your repository.

---

### ✅ Here's what to do step-by-step:

1. **Open your project folder** (e.g., `D:\practicals\PHP`) in VS Code or any text editor.

2. **Create a new file** named:

   ```
   .gitattributes
   ```

   > ✅ Yes, the filename starts with a dot and has no extension.

3. **Paste this line into that file**:

   ```
   *.php linguist-language=PHP
   ```

4. **Save the file.**

5. **Commit it to your repo** via Git:

   Open a terminal in the root of your project folder and run:

   ```bash
   git add .gitattributes
   git commit -m "Fix GitHub language detection to PHP"
   git push
   ```

---

### 💡 What This Does

This tells GitHub's **Linguist** tool to **treat all `.php` files as PHP**, not Hack, fixing the inaccurate language stats in your repository.

Let me know if you need help verifying if it worked or checking GitHub again after pushing!

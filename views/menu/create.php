<h1>Créer un nouveau menu</h1>

<form action="index.php?controller=menu&action=create" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom du menu :</label>
    <input type="text" name="nom" id="nom" required><br><br>

    <label for="prix">Prix (€) :</label>
    <input type="number" step="0.01" name="prix" id="prix" required><br><br>

    <label for="image">Image du menu :</label>
    <input type="file" name="image" id="image" accept="image/*"><br><br>

    <button type="submit">Créer le menu</button>
</form>
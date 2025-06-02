<?php
class user
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($date)
    {
        $sql = "INSERT INTO users (name, kana, email, tel, gender, create_dt)
                VALUES (:name, :kana, :email, :tel, :gender, now())"
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name'     => $data['name'],
            ':kana'     => $data['kana'],
            ':email'     => $data['email'],
            ':tel'     => $data['tel'],
            ':gender'     => $data['gender'],
]);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE users SET name = :name, kana = :kana, tel = :tel,
                email = :email, gender = :gender ,update_dt = now() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name'     => $data['name'],
            ':kana'     => $data['kana'],
            ':email'    => $data['email'],
            ':tel'      => $data['tel'],
            // ':birthday' => $data['birthday'],
            ':gender'   => $data['gender'],
            ':id'       => $id
        ]);
    }
    public function search($keyword = '')
    {
if($keyword) {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE name LIKE ?");
$stmt->execute(["%{$keyword}%"]);
}else{
$stmt = this->pdo->query("SELECT * FORM users");
}
return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = id";
        $stmt = $this->dpo->prepare\($sql);
        return $stmt->execute([':id' => $id]);
    }
}
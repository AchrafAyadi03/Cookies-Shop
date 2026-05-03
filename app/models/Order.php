<?php
require_once(__DIR__ . '/Database.php');

class Order {

    private function db() {
        $cnx = new connexion();
        return $cnx->CNXbase();
    }

    public function create($userId, array $items) {
        $db = $this->db();
        $db->beginTransaction();
        try {
            $total = 0;
            foreach ($items as $it) {
                $total += $it['prix'] * $it['quantite'];
            }

            $stmt = $db->prepare(
                "INSERT INTO commande (utilisateur_id, total, statut)
                 VALUES (:uid, :total, 'en_attente')"
            );
            $stmt->execute([':uid' => $userId, ':total' => $total]);
            $commandeId = (int)$db->lastInsertId();

            $stmtDet = $db->prepare(
                "INSERT INTO commande_details (commande_id, cookie_id, quantite, prix_unitaire)
                 VALUES (:cid, :cookie, :qte, :prix)"
            );
            foreach ($items as $it) {
                $stmtDet->execute([
                    ':cid'    => $commandeId,
                    ':cookie' => (int)$it['id'],
                    ':qte'    => (int)$it['quantite'],
                    ':prix'   => (float)$it['prix'],
                ]);
            }

            $db->commit();
            return $commandeId;
        } catch (Exception $e) {
            $db->rollBack();
            return false;
        }
    }

    public function listAll() {
        $db = $this->db();
        $sql = "SELECT c.id, c.date_commande, c.total, c.statut,
                       u.nom, u.prenom, u.email
                FROM commande c
                JOIN utilisateur u ON u.id = c.utilisateur_id
                ORDER BY c.date_commande DESC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listByUser($userId) {
        $db = $this->db();
        $stmt = $db->prepare(
            "SELECT id, date_commande, total, statut
             FROM commande WHERE utilisateur_id = :uid
             ORDER BY date_commande DESC"
        );
        $stmt->execute([':uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetails($commandeId) {
        $db = $this->db();
        $stmt = $db->prepare(
            "SELECT c.id, c.date_commande, c.total, c.statut,
                    u.nom, u.prenom, u.email, u.telephone
             FROM commande c
             JOIN utilisateur u ON u.id = c.utilisateur_id
             WHERE c.id = :id"
        );
        $stmt->execute([':id' => $commandeId]);
        $commande = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$commande) return null;

        $stmt2 = $db->prepare(
            "SELECT d.quantite, d.prix_unitaire,
                    ck.id AS cookie_id, ck.nom, ck.image
             FROM commande_details d
             JOIN cookies ck ON ck.id = d.cookie_id
             WHERE d.commande_id = :id"
        );
        $stmt2->execute([':id' => $commandeId]);
        $commande['lignes'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $commande;
    }

    public function updateStatus($commandeId, $statut) {
        $allowed = ['en_attente', 'validee', 'livree'];
        if (!in_array($statut, $allowed, true)) return false;

        $db = $this->db();
        $stmt = $db->prepare("UPDATE commande SET statut = :s WHERE id = :id");
        return $stmt->execute([':s' => $statut, ':id' => (int)$commandeId]);
    }
}
?>

class TreeNode:
    def __init__(self, key):
        self.key = key
        self.left = None
        self.right = None

class BinarySearchTree:
    def __init__(self):
        self.root = None

    # Insert a node into the BST
    def insert(self, key):
        if self.root is None:
            self.root = TreeNode(key)
        else:
            self._insert_recursive(self.root, key)

    def _insert_recursive(self, node, key):
        if key < node.key:
            if node.left is None:
                node.left = TreeNode(key)
            else:
                self._insert_recursive(node.left, key)
        elif key > node.key:
            if node.right is None:
                node.right = TreeNode(key)
            else:
                self._insert_recursive(node.right, key)

    # Search for a node in the BST
    def search(self, key):
        return self._search_recursive(self.root, key)

    def _search_recursive(self, node, key):
        if node is None or node.key == key:
            return node is not None
        if key < node.key:
            return self._search_recursive(node.left, key)
        return self._search_recursive(node.right, key)

    # Delete a node from the BST
    def delete(self, key):
        self.root = self._delete_recursive(self.root, key)

    def _delete_recursive(self, node, key):
        if node is None:
            return node
        if key < node.key:
            node.left = self._delete_recursive(node.left, key)
        elif key > node.key:
            node.right = self._delete_recursive(node.right, key)
        else:
            # Node with only one child or no child
            if node.left is None:
                return node.right
            elif node.right is None:
                return node.left
            # Node with two children: Get the inorder successor
            temp = self._min_value_node(node.right)
            node.key = temp.key
            node.right = self._delete_recursive(node.right, temp.key)
        return node

    # Helper method to find the minimum value node
    def _min_value_node(self, node):
        current = node
        while current.left is not None:
            current = current.left
        return current

    # Print the tree for demonstration (Inorder traversal)
    def inorder_traversal(self, node):
        if node is not None:
            self.inorder_traversal(node.left)
            print(node.key, end=' ')
            self.inorder_traversal(node.right)

# Example usage
if __name__ == "__main__":
    bst = BinarySearchTree()

    # Demonstrate insertion
    print("Inserting values: 15, 10, 20, 8, 12, 17, 25")
    values_to_insert = [15, 10, 20, 8, 12, 17, 25]
    for value in values_to_insert:
        bst.insert(value)

    print("Inorder Traversal after insertion:")
    bst.inorder_traversal(bst.root)  # Should print the values in sorted order
    print("\n")

    # Demonstrate search
    print("Searching for 10:", bst.search(10))  # Output: True
    print("Searching for 5:", bst.search(5))    # Output: False

    # Demonstrate deletion
    print("Deleting 10 (a node with one child)")
    bst.delete(10)
    print("Inorder Traversal after deleting 10:")
    bst.inorder_traversal(bst.root)
    print("\n")

    print("Deleting 15 (a node with two children)")
    bst.delete(15)
    print("Inorder Traversal after deleting 15:")
    bst.inorder_traversal(bst.root)
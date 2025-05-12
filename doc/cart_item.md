```mermaid
flowchart TD

subgraph Cart
index[商品一覧]
cart[カート一覧]
add{購入}
complete[完了画面]

index--->|カートに入れる|cart-->add-.->complete

end
```
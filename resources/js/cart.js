/**
 * @file cart.js
 * @description Events-driven shopping cart for Agrivall.
 * Final version: no reload on last item, hidden spin buttons via CSS.
 */

const VAT_RATE = 0.21;

/**
 * Format a number as EUR using es-ES locale.
 * @param {number} amount
 * @returns {string}
 */
function formatEUR(amount) {
    return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(amount);
}

class Cart {
    constructor() {
        /** @private */ this._items = new Map();
    }

    load(seed) {
        console.log("Loading cart with seed:", seed);
        seed.forEach(p => {
            this._items.set(Number(p.id), {
                id: Number(p.id),
                name: p.name,
                price: parseFloat(p.price),
                qty: parseInt(p.quantity || p.qty),
                format: p.format,
                image: p.image
            });
        });
    }

    inc(id) {
        const it = this._items.get(Number(id));
        if (!it) return;
        it.qty += 1;
        this.syncWithServer(it.id, it.qty);
    }

    dec(id) {
        const it = this._items.get(Number(id));
        if (!it) return;
        it.qty = Math.max(0, it.qty - 1);
        if (it.qty === 0) {
            this.remove(it.id);
        } else {
            this.syncWithServer(it.id, it.qty);
        }
    }

    setQty(id, qty) {
        const it = this._items.get(Number(id));
        if (!it) return;
        const q = Number.isFinite(qty) ? Math.max(1, Math.trunc(qty)) : it.qty;
        it.qty = q;
        this.syncWithServer(it.id, it.qty);
    }

    remove(id) {
        const numericId = Number(id);
        this._items.delete(numericId);
        console.log("Removing item:", numericId);
        
        fetch('/cart/remove', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id: numericId })
        });
    }

    async syncWithServer(id, qty) {
        try {
            await fetch('/cart/update', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: Number(id), quantity: Number(qty) })
            });
        } catch (error) {
            console.error('Error syncing cart:', error);
        }
    }

    list() { return Array.from(this._items.values()); }

    totals(discountRate = 0) {
        const subtotal = this.list().reduce((acc, it) => acc + it.price * it.qty, 0);
        const vat = subtotal * VAT_RATE;
        const discount = subtotal * Math.max(0, Math.min(1, discountRate));
        return { subtotal, vat, discount, total: subtotal + vat - discount };
    }
}

function discountFromCode(code) {
    const c = (code || '').trim().toUpperCase();
    if (c === 'DESCUENTO10') return 0.10;
    if (c === 'DESCUENTO20') return 0.20;
    return 0;
}

function renderRows(cart, tbody) {
    const items = cart.list();
    const cartContent = document.getElementById('cart-content');
    const emptyMsg = document.getElementById('empty-cart-msg');

    // Handle initial/empty state without reload
    if (items.length === 0) {
        if (cartContent) cartContent.style.display = 'none';
        if (emptyMsg) emptyMsg.style.display = 'block';
        return;
    } else {
        if (cartContent) cartContent.style.display = 'block';
        if (emptyMsg) emptyMsg.style.display = 'none';
    }

    tbody.textContent = '';
    const baseUrl = window.Agrivall?.baseUrl || '/';

    items.forEach(it => {
        const tr = document.createElement('tr');
        tr.dataset.id = String(it.id);
        tr.innerHTML = `
            <td>
                <div style="display:flex; align-items:center; gap:15px;">
                    ${it.image ? `<img src="${baseUrl}${it.image}" alt="" style="width:60px; height:60px; object-fit:cover; border-radius:4px;">` : ''}
                    <strong>${it.name}</strong>
                </div>
            </td>
            <td>${it.format}</td>
            <td>${it.price.toFixed(2)} €</td>
            <td>
                <div class="qty" style="display:flex; gap:10px; align-items:center;">
                    <button type="button" class="btn-minus" style="padding: 2px 8px; cursor:pointer;">-</button>
                    <input type="number" min="1" class="input-qty" value="${it.qty}" style="width: 50px; text-align:center;">
                    <button type="button" class="btn-plus" style="padding: 2px 8px; cursor:pointer;">+</button>
                </div>
            </td>
            <td class="cell-amount">${formatEUR(it.price * it.qty)}</td>
            <td style="text-align: right;">
                <button type="button" class="btn-remove" style="background:none; border:none; color:#e74c3c; cursor:pointer;">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>`;
        tbody.appendChild(tr);
    });
}

function renderTotals(t) {
    document.getElementById('subtotal').textContent = formatEUR(t.subtotal);
    document.getElementById('iva').textContent = formatEUR(t.vat);
    document.getElementById('discount').textContent = formatEUR(t.discount);
    document.getElementById('total-final').textContent = formatEUR(t.total);
}

function updateRowAndTotals(cart, row, rate) {
    const id = Number(row.dataset.id);
    const it = cart.list().find(x => x.id === id);
    if (!it) return;

    const input = row.querySelector('.input-qty');
    if (input) input.value = String(it.qty);

    const amountCell = row.querySelector('.cell-amount');
    if (amountCell) amountCell.textContent = formatEUR(it.price * it.qty);

    renderTotals(cart.totals(rate));
}

function attachCartEvents(cart) {
    const tbody = document.getElementById('cart-body');
    if (!tbody) return;

    const codeEl = document.getElementById('promo-code');
    let rate = 0;

    renderTotals(cart.totals(rate));

    tbody.addEventListener('click', ev => {
        const target = ev.target;
        const row = target.closest('tr');
        if (!row) return;
        const id = Number(row.dataset.id);

        if (target.closest('.btn-plus')) {
            cart.inc(id);
            updateRowAndTotals(cart, row, rate);
        } else if (target.closest('.btn-minus')) {
            cart.dec(id);
            if (!cart.list().find(x => x.id === id)) {
                renderRows(cart, tbody);
            } else {
                updateRowAndTotals(cart, row, rate);
            }
        } else if (target.closest('.btn-remove')) {
            if (confirm('¿Eliminar este producto?')) {
                cart.remove(id);
                renderRows(cart, tbody);
                renderTotals(cart.totals(rate));
            }
        }
    });

    tbody.addEventListener('input', ev => {
        const input = ev.target.closest('.input-qty');
        if (!input) return;
        const row = ev.target.closest('tr');
        const id = Number(row.dataset.id);
        const value = Math.max(1, Math.trunc(Number(input.value)) || 1);
        cart.setQty(id, value);
        updateRowAndTotals(cart, row, rate);
    });

    const promoForm = document.getElementById('promo-form');
    if (promoForm) {
        promoForm.addEventListener('submit', ev => {
            ev.preventDefault();
            rate = discountFromCode(codeEl.value);
            const msg = document.getElementById('promo-msg');
            msg.textContent = rate > 0 ? `Cupón aplicado: ${(rate * 100).toFixed(0)}%` : 'Cupón inválido';
            msg.style.color = rate > 0 ? 'green' : 'red';
            renderTotals(cart.totals(rate));
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (typeof SEED !== 'undefined') {
        const cart = new Cart();
        cart.load(SEED);
        attachCartEvents(cart);
    }
});

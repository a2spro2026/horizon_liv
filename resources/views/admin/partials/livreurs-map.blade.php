<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">

@if (! empty($showMapHeader))
    <div class="section-header">
        <h3 class="section-title">
            <span class="section-title-ico" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
            </span>
            <span class="section-title-text">
                <small>Livreurs</small>
                {{ $mapTitle ?? 'Carte Livreurs' }}
            </span>
        </h3>
        @if (! empty($showMapClose))
            <div class="section-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-close">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                    Fermer
                </a>
            </div>
        @endif
    </div>
@endif

<div class="livreurs-map-wrap">
    <div id="{{ $mapId ?? 'livreurs-map' }}" class="livreurs-map" role="img" aria-label="Carte des livreurs"></div>
    <div class="map-legend">
        <span><strong>{{ count($mapPoints ?? []) }}</strong> livreur(s) localisé(s)</span>
        <span>Cliquez un marqueur pour voir le détail</span>
    </div>
</div>

@if (empty($mapPoints))
    <p class="empty-state" style="margin-top:1rem;">Aucun livreur localisé pour le moment. Les positions apparaîtront ici dès qu’un livreur enverra son GPS.</p>
@endif

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    (function () {
        const points = @json($mapPoints ?? []);
        const mapId = @json($mapId ?? 'livreurs-map');
        const map = L.map(mapId).setView([31.7917, -7.0926], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        const orangeIcon = L.divIcon({
            className: '',
            html: '<div style="width:16px;height:16px;border-radius:50%;background:#f26522;border:2px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.35);"></div>',
            iconSize: [16, 16],
            iconAnchor: [8, 8],
            popupAnchor: [0, -10]
        });

        const bounds = [];
        points.forEach((p) => {
            const marker = L.marker([p.lat, p.lng], { icon: orangeIcon }).addTo(map);
            marker.bindPopup(
                '<div class="popup-name">' + (p.nom || '') + '</div>' +
                '<div class="popup-meta">' + (p.ville || '') + '<br>' + (p.contact || '') + '<br>' + (p.email || '') +
                (p.updated ? ('<br>MAJ: ' + p.updated) : '') +
                '</div>'
            );
            bounds.push([p.lat, p.lng]);
        });

        if (bounds.length === 1) {
            map.setView(bounds[0], 13);
        } else if (bounds.length > 1) {
            map.fitBounds(bounds, { padding: [40, 40] });
        }

        setTimeout(() => map.invalidateSize(), 200);
    })();
</script>

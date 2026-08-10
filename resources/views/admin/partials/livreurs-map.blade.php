<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">

@php
    $points = $mapPoints ?? [];
    $livreurCount = collect($points)->where('type', 'livreur')->count();
    $clientCount = collect($points)->where('type', 'client')->count();
@endphp

@if (! empty($showMapHeader))
    <div class="section-header">
        <h3 class="section-title">
            <span class="section-title-ico" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
            </span>
            <span class="section-title-text">
                <small>Localisation</small>
                {{ $mapTitle ?? 'Carte des positions' }}
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
    <div id="{{ $mapId ?? 'livreurs-map' }}" class="livreurs-map" role="img" aria-label="Carte livreurs et clients"></div>
    <div class="map-legend">
        <span><span class="legend-dot legend-livreur"></span> <strong>{{ $livreurCount }}</strong> livreur(s)</span>
        <span><span class="legend-dot legend-client"></span> <strong>{{ $clientCount }}</strong> client(s)</span>
        <span>Cliquez un marqueur pour voir le détail</span>
    </div>
</div>

@if (empty($points))
    <p class="empty-state" style="margin-top:1rem;">Aucune position enregistrée. Les livreurs et clients localisés apparaîtront ici.</p>
@endif

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    (function () {
        const points = @json($points);
        const mapId = @json($mapId ?? 'livreurs-map');
        const map = L.map(mapId).setView([31.7917, -7.0926], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        function makeIcon(color) {
            return L.divIcon({
                className: '',
                html: '<div style="width:16px;height:16px;border-radius:50%;background:' + color + ';border:2px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.35);"></div>',
                iconSize: [16, 16],
                iconAnchor: [8, 8],
                popupAnchor: [0, -10]
            });
        }

        const livreurIcon = makeIcon('#f26522');
        const clientIcon = makeIcon('#1d4ed8');
        const bounds = [];

        points.forEach((p) => {
            const isClient = p.type === 'client';
            const marker = L.marker([p.lat, p.lng], {
                icon: isClient ? clientIcon : livreurIcon
            }).addTo(map);

            marker.bindPopup(
                '<div class="popup-name">' + (p.nom || '') + '</div>' +
                '<div class="popup-meta">' +
                '<strong>' + (isClient ? 'Client' : 'Livreur') + '</strong><br>' +
                (p.ville || '') + '<br>' + (p.contact || '') +
                (p.email ? ('<br>' + p.email) : '') +
                (p.activite ? ('<br>' + p.activite) : '') +
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

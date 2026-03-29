<div>
    <div wire:ignore.self class="modal fade" id="modalLoan" tabindex="-1" aria-labelledby="modalLoanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="saveLoan">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLoanLabel">Input Loan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="loan" class="form-label">Loan</label>
                            <select id="loan" class="form-select" wire:model="id_loan">
                                <option value="">-</option>
                                @foreach ($loans as $loanItem)
                                    <option value="{{ $loanItem->id_loan }}">{{ $loanItem->loan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading wire:target="saveLoan" class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            window.addEventListener('show-loan-modal', () => {
                const modal = new bootstrap.Modal(document.getElementById('modalLoan'));
                modal.show();
            });

            window.addEventListener('hide-loan-modal', () => {
                const modalEl = document.getElementById('modalLoan');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                }
                // Ensure backdrop is removed correctly to avoiding ghost overlays
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            });
        });
    </script>
    @endpush
</div>
